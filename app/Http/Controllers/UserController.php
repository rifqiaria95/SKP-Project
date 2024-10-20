<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KetStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //  Function Index untuk menampilkan data user
    public function index(Request $request)
    {
        // Menampilkan Data user
        $user       = User::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($user)
            ->addColumn('status_user', function(User $user) {
                $inactive = '<span class="badge bg-label-danger">Inactive</span>';
                $active   = '<span class="badge bg-label-success">Active</span>';
                if($user->status_user == 0) {
                    return $inactive;
                }  else if ($user->status_user == 1) {
                    return $active;
                }
            })
            ->addColumn('aksi', function ($data) {
                $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-user"><i class="fa-solid fa-pen"></i></a>
                    <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                    <a href="user/profile/' . $data->id . '" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                </div>
            </div>';
                return $button;
            })
            ->rawColumns(['status_user', 'aksi'])
            ->addIndexColumn()
            ->toJson();
        }

        return view('user.index', compact(['user']));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update($id, Request $request)
    {
        $messages  = [
            'required' => 'Kolom harus diisi.',
            'string'   => 'Kolom harus berupa teks.',
            'max'      => 'Kolom maksimal :max kata.',
            'mimes'    => 'Format file harus jpg/png.',
        ];
        
        $validator = Validator::make($request->all(), [
            'avatar'        => 'mimes:jpg,png'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 400,
                'errors'  => $validator->messages(),
            ]);
        } else {
            $user = User::find($id);
            if ($user) {
                $user->update($request->all());

                if ($request->hasfile('avatar')) {
                    $path = 'images/' . $user->avatar;
                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
                    $user->avatar = $request->file('avatar')->getClientOriginalName();
                }

                $user->save();

                \ActivityLog::addToLog('Mengubah data user');

                return response()->json([
                    'status'    => 200,
                    'message'   => 'Data user berhasil diubah'
                ]);
            } else {
                return response()->json([
                    'status'    => 404,
                    'errors'    => 'User Tidak Ditemukan'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $path = 'images/' . $user->avatar;
            if (File::exists($path)) {
                File::delete($path);
            }
            $user->delete();

            \ActivityLog::addToLog('Menghapus data user');

            return response()->json([
                'status' => 200,
                'message' => 'Data User Berhasil Dihapus'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'errors' => 'Data User Tidak Ditemukan'
            ]);
        }
    }

    public function profile($id)
    {
        $user     = User::find($id);
        return view('user.profile', compact(['user']));
    }
}
