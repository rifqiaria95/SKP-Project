<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;

class AbsensiController extends Controller
{
	public function index(Request $request) {
		// Menampilkan Data absensi
        $absensi      = Absensi::all();
        $karyawan     = Karyawan::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($absensi)
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
				->addColumn('karyawan', function (Karyawan $karyawan) {
                    return $karyawan->absensi->nama_karyawan;
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('absensi.index', compact(['absensi', 'karyawan']));
	}

	public function create() {
		return view('absensi.create');
	}

    public function store(Request $request)
    {
		// dd($request->all());
    	$this->validate($request, [
			'nama_karyawan' => 'required',
			'status' => 'required'
		]);
	
		$existingdata = Absensi::where('nama_karyawan', $request->nama_karyawan)->whereDay('created_at', now()->day)->first();
		// dd($existingdata);
		if ($existingdata) {
			
			return redirect()->back()->with('error', 'Uppsss, kamu hanya boleh isi 1 kali!');
		}

		// $clientIP = \Request::ip();
  
		// dd($clientIP);

		// DB::enableQueryLog();
		Absensi::create([
			'nama_karyawan' => $request->nama_karyawan,
			'status' => $request->status_manual ?? $request->status
		]);
		// dd(DB::getQueryLog());
		

    	return redirect()->back()->with('success', 'Berhasil, kamu telah absen pada tanggal:');
    }

}
