<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
	public function index(Request $request) {
		// Menampilkan Data absensi
        $absensi      = Absensi::all();
		// dd($absensi);
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
                       <a href="absensi/' . $data->id . '/profile" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
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
		$validator = Validator::make($request->all(), [
            'status'        => 'required|string|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages()
            ]);
        } else {
			$existingdata = Absensi::where('karyawan_id', $request->karyawan_id)->whereDay('created_at', now()->day)->first();
			// dd($existingdata);
			if ($existingdata) {
				
				return response()->json([
					'status'    => 409,
					'errors'    => 'Kamu hanya boleh mengisi 1 kali!'
				]);
			}

			// $clientIP = \Request::ip();
	
			// dd($clientIP);

			// DB::enableQueryLog();
			$status        		  	  = $request->status_manual ?? $request->status;
			$karyawan_id         	  = $request->karyawan_id;

			$absensi 				  = new Absensi;
			$absensi->status  		  = $status;
			$absensi->karyawan_id  	  = $karyawan_id;
			$absensi->save();
			
			return response()->json([
                'status'        => 200,
                'message'       => 'Berhasil, ditambahkan pada tanggal: ',
				'timestamp' 	=> $absensi = Carbon::now()->isoFormat('D MMMM Y h:mm a')
            ]);
            
        }
		// dd($request->all());
	
		
		// Absensi::create([
		// 	'status' => $request->status_manual ?? $request->status,
		// 	'karyawan_id' => $request->karyawan->id
		// ]);
		// dd(DB::getQueryLog());
		

    	// return redirect()->back()->with('success', 'Berhasil, kamu telah absen pada tanggal:');
    }

}
