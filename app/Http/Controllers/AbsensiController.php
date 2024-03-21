<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
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
                    <button type="button" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#editModal"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-absensi"><i class="fa-solid fa-pen"></i></button>
                    <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                </div>
            </div>';
                    return $button;
                })
                ->rawColumns(['status', 'aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('absensi.index', compact(['absensi', 'karyawan']));
    }

    public function create()
    {
        $absensi      = Absensi::all();
        $karyawan     = Karyawan::orderBy("nama_depan", "asc")->get();

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

        // Tentukan jumlah maksimum input berdasarkan job title
        $maxInserts = ($job_title === 'Supir' || $job_title === 'Office Boy') ? 2 : 1;

        // Periksa apakah pengguna memiliki peran 'owner' atau 'admin'
        if (auth()->user('owner' && 'admin')) {
            $maxInserts = -1; // Tandai sebagai tidak terbatas untuk admin & owner
        }

        // Hitung jumlah data absensi yang sudah ada untuk karyawan tertentu pada hari ini
        $existingDataCount = Absensi::where('karyawan_id', $karyawan_id)
            ->whereDate('created_at', now()->toDateString())
            ->count();

        // Jika jumlah input sudah mencapai batas maksimum
        if ($existingDataCount >= $maxInserts && $maxInserts != -1) {
            return response()->json([
                'status' => 409,
                'errors' => 'Oops, Anda hanya boleh input ' . $maxInserts . ' kali!',
            ]);
        }

        // Buat objek Absensi dan simpan data jika memenuhi syarat
        $absensi = new Absensi;
        $absensi->status          = $status;
        $absensi->job_title       = $job_title;
        $absensi->tanggal_absensi = $tanggal_absensi;
        $absensi->karyawan_id     = $karyawan_id;
        $absensi->save();

        // Tambahkan aktivitas log
        \ActivityLog::addToLog('Menambah data absensi');

        // Kirim respons berhasil
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil, ditambahkan pada tanggal: ',
            'timestamp' => $absensi->created_at->toDateTimeString(),
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

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            // dd($request->all());
            \ActivityLog::addToLog('Mengubah data absensi');

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

        \ActivityLog::addToLog('Menghapus data absensi');

        if ($absensi) {
            $absensi->delete();
            return response()->json([
                'status'    => 200,
                'message'   => 'Sukses! Data absensi berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'status'    => 404,
                'errors'    => 'Error! Data absensi tidak ditemukan'
            ]);
        }
    }
}
