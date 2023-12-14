<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use App\Exports\KaryawanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data karyawan
        $karyawan      = Karyawan::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($karyawan)
            ->addColumn('aksi', function ($data) {
                $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-karyawan"><i class="fa-solid fa-pen"></i></a>
                    <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                    <a href="karyawan/' . $data->id . '/profile" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                </div>
            </div>';
                return $button;
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->toJson();
        }

        return view('karyawan.index', compact(['karyawan']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar'        => 'mimes:jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages()
            ]);
        } else {

            // Insert Table User
            $user                    = new User;
            $user->role              = 'karyawan';
            $user->status_user       = 1;
            $user->name              = $request->nama_depan;
            $user->email             = $request->email;
            $user->email_verified_at = now();
            $user->password          = bcrypt('rahasia');
            $user->remember_token    = Str::random(60);
            $user->save();

            // Insert Table karyawan
            $request->request->add(['user_id' => $user->id]);
            $karyawan = karyawan::create($request->all());
            if ($karyawan) {
                if ($request->hasfile('avatar')) {
                    $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
                    $karyawan->avatar = $request->file('avatar')->getClientOriginalName();
                }
                $karyawan->save();

                \ActivityLog::addToLog('Menambah data karyawan');

                return response()->json([
                    'status'    => 200,
                    'message'   => 'Data karyawan Berhasil Ditambahkan'
                ]);
            } else {
                return response()->json([
                    'status'    => 404,
                    'errors'    => 'Data karyawan Tidak Ditemukan'
                ]);
            }
        }
    }

    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        return response()->json($karyawan);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar'        => 'mimes:jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages()
            ]);
        } else {
            $karyawan = Karyawan::find($id);
            if ($karyawan) {
                $karyawan->update($request->all());

                if ($request->hasfile('avatar')) {
                    $path = 'images/' . $karyawan->avatar;
                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
                    $karyawan->avatar = $request->file('avatar')->getClientOriginalName();
                }

                $karyawan->save();

                \ActivityLog::addToLog('Mengubah data karyawan');

                return response()->json([
                    'status'    => 200,
                    'message'   => 'Data karyawan berhasil diubah'
                ]);
            } else {
                return response()->json([
                    'status'    => 404,
                    'errors'    => 'Karyawan Tidak Ditemukan'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        if ($karyawan) {
            $path = 'images/' . $karyawan->avatar;
            if (File::exists($path)) {
                File::delete($path);
            }
            $karyawan->delete();

            \ActivityLog::addToLog('Menghapus data karyawan');

            return response()->json([
                'status' => 200,
                'message' => 'Data Karyawan Berhasil Dihapus'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'errors' => 'Data Karyawan Tidak Ditemukan'
            ]);
        }
    }

    public function exportExcelKaryawan() 
    {
        return Excel::download(new KaryawanExport, 'karyawan.xlsx');
    }
}
