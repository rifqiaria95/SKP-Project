<?php

namespace App\Http\Controllers;

use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
	public function index(Request $request) {
		// Menampilkan Data absensi
        $absensi      = Absensi::all();
        $karyawan     = Karyawan::all();
        if ($request->ajax()) {
            if ($request->input('tanggal_awal') && $request->input('tanggal_akhir')) {
 
                $tanggal_awal  = Carbon::parse($request->input('tanggal_awal'))->locale('id_ID');
                $tanggal_akhir = Carbon::parse($request->input('tanggal_akhir'))->locale('id_ID');
 
                if ($tanggal_akhir->gte($tanggal_awal)) {
                    $absensi = Absensi::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
                } else if ($tanggal_awal->lte($tanggal_akhir)) {
                    $absensi = Absensi::whereDate('created_at', [$tanggal_awal, $tanggal_akhir]);
                } else {
                    $absensi = Absensi::latest()->get();
                }
            } else {
                $absensi = Absensi::latest()->get();
            }
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
            ->rawColumns(['status','aksi'])
            ->addIndexColumn()
            ->toJson();
        }

        return view('absensi.index', compact(['absensi', 'karyawan']));
	}

	public function create() {
		$absensi      = Absensi::all();
        $karyawan     = Karyawan::orderBy("nama_depan", "asc")->get();;

		return view('absensi.create', compact(['absensi', 'karyawan']));
	}

    public function getTitle($id)
    {
        $karyawan = Karyawan::find($id);
        return response()->json($karyawan);
    }

    public function store(Request $request)
    { 
        $status          = $request->status;
        $job_title       = $request->job_title;
        $karyawan_id     = $request->karyawan_id;
        $tanggal_absensi = $request->tanggal_absensi;

        $maxInserts = ($job_title == 'Supir') ? 2 : 1;

        $existingDataCount = Absensi::where('karyawan_id', $karyawan_id)
            ->whereDay('created_at', now()->day)
            ->count();

        if (auth()->user('owner' && 'admin')) {
            $absensi                  = new Absensi;
            $absensi->status          = $status;
            $absensi->job_title       = $job_title;
            $absensi->tanggal_absensi = $tanggal_absensi;
            $absensi->karyawan_id     = $karyawan_id;
            $absensi->save();

            return response()->json([
                'status'    => 200,
                'message'   => 'Berhasil, ditambahkan pada tanggal_absensi: ',
                'timestamp' => $absensi = Carbon::now()->isoFormat('D MMMM Y h:mm a'),
            ]);
            
        } else if ($existingDataCount >= $maxInserts) {
            return response()->json([
                'status' => 409,
                'errors' => 'You can only input ' . $maxInserts . ' times!',
            ]);
        }

        $absensi                  = new Absensi;
        $absensi->status          = $status;
        $absensi->job_title       = $job_title;
        $absensi->tanggal_absensi = $tanggal_absensi;
        $absensi->karyawan_id     = $karyawan_id;
        $absensi->save();

        return response()->json([
            'status'    => 200,
            'message'   => 'Berhasil, ditambahkan pada tanggal_absensi: ',
            'timestamp' => $absensi = Carbon::now()->isoFormat('D MMMM Y h:mm a'),
        ]);
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
            'karyawan_id'     => 'required|string|max:30',
            'status'          => 'required|max:35',
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
            $absensi                  = Absensi::find($id);
            $absensi->status          = $request->status;
            $absensi->job_title       = $request->job_title;
            $absensi->tanggal_absensi = $request->tanggal_absensi;
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

    public function exportExcel(Request $request) 
    {
        $tanggal_awal  = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        // dd($request->all() ) ;

        return Excel::download(new AbsensiExport($tanggal_awal, $tanggal_akhir), 'absensi.xlsx');
    }

    public function exportPDF()
    {
        $absensi = Absensi::all();
        $pdf     = PDF::loadview('absensi.exportpdf', ['absensi' => $absensi]);
        return $pdf->download('Meal Attendance.pdf');
    }

}
