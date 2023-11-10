<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{
	public function index() {
		return view('fe-absensi.index');
	}

    public function store(Request $request)
    {
		// dd($request->all());
    	$this->validate($request, [
			'nama' => 'required',
			'status' => 'required'
		]);
	
		$existingdata = Absensi::where('nama', $request->nama)->whereDay('created_at', now()->day)->first();
		// dd($existingdata);
		if ($existingdata) {
			
			return redirect()->back()->with('error', 'Uppsss, kamu hanya boleh isi 1 kali!');
		}

		// $clientIP = \Request::ip();
  
		// dd($clientIP);

		// DB::enableQueryLog();
		Absensi::create([
			'nama' => $request->nama,
			'status' => $request->status_manual ?? $request->status
		]);
		// dd(DB::getQueryLog());
		

    	return redirect()->back()->with('success', 'Berhasil, kamu telah absen pada tanggal:');
    }

}
