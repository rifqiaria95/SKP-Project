<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
	public function index(Request $request) {
		// Menampilkan Data absensi
        $absensi      = Absensi::all();
        $karyawan     = Karyawan::all();
        if ($request->ajax()) {
            return datatables()->of($absensi)
				->addColumn('karyawan', function (Absensi $absensi) {
					return $absensi->karyawan->nama_depan;
				})
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                   <div class="btn-group me-2" role="group" aria-label="First group">
                       <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-absensi"><i class="fa-solid fa-pen"></i></a>
                       <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                   </div>
               </div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('absensi.index', compact(['absensi', 'karyawan']));
	}

	public function create() {
		$absensi      = Absensi::all();
        $karyawan     = Karyawan::all();

		return view('absensi.create', compact(['absensi', 'karyawan']));
	}

    public function store(Request $request)
    {
        // dd($request->all());
        $messages  = [
            'required'  =>  'Kolom :attribute harus diisi.',
            'string'    =>  'Kolom :attribute harus berupa teks.',
            'max'       =>  'Kolom :attribute maksimal :max kata.'
        ];

        $validator = Validator::make($request->all(), [
            'status'        => 'required|string|max:30',
            'karyawan_id'   => 'required|string|max:30',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);

        } else {
            $status      = $request->status_manual ?? $request->status;
            $karyawan_id = $request->karyawan_id;

            $maxInserts  = ($status == 'supir') ? 2 : 1;

            $existingDataCount = Absensi::where('karyawan_id', $karyawan_id)
                ->whereDay('created_at', now()->day)
                ->count();

            if ($existingDataCount >= $maxInserts) {
                return response()->json([
                    'status' => 409,
                    'errors' => 'Kamu hanya boleh mengisi ' . $maxInserts . ' kali!',
                ]);
            }

            $absensi                = new Absensi;
            $absensi->status        = $status;
            $absensi->karyawan_id   = $karyawan_id;
            $absensi->save();

            return response()->json([
                'status'    => 200,
                'message'   => 'Berhasil, ditambahkan pada tanggal: ',
                'timestamp' => $absensi = Carbon::now()->isoFormat('D MMMM Y h:mm a'),
            ]);
        }
    }

	public function edit($id)
    {
        $absensi = Absensi::find($id);
        return response()->json($absensi);
    }

	public function update($id, Request $request)
    {
        $messages  = [
            'required'  =>  'Kolom :attribute harus diisi.',
            'string'    =>  'Kolom :attribute harus berupa teks.',
            'max'       =>  'Kolom :attribute maksimal :max kata.'
        ];

        $validator = Validator::make($request->all(), [
            'karyawan_id'          => 'required|string|max:30',
            'status'      	   	   => 'required|max:35',
        ], $messages);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else {
            // dd($request->all());
            $absensi              	  = Absensi::find($id);
            $absensi->status    	  = $request->status;
            $absensi->karyawan_id     = $request->karyawan_id;
            $absensi->save();
            
            return response()->json([
                'status'    => 200,
                'message'   => 'Sukses! Data absensi berhasil diupdate'
            ]);
        }
    }

	public function destroy($id)
    {
        $absensi = Absensi::find($id);
        if($absensi)
        {
            $absensi->delete();
            return response()->json([
                'status'    => 200,
                'message'   => 'Sukses! Data absensi berhasil dihapus'
            ]);
        }
        else
        {
            return response()->json([
                'status'    => 404,
                'errors'    => 'Error! Data absensi tidak Ditemukan'
            ]);
        }
    }

    public function exportExcel() 
    {
        return Excel::download(new AbsensiExport, 'absensi.xlsx');
    }

}
