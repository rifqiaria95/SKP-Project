<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerusahaanController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data perusahaan
        $perusahaan       = Perusahaan::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($perusahaan)
            ->addColumn('aksi', function ($data) {
                $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-perusahaan"><i class="fa-solid fa-pen"></i></a>
                    <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                    <a href="perusahaan/profile/' . $data->id . '" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                    </div>
                </div>';
                return $button;
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->toJson();
        }

        return view('perusahaan.index', compact(['perusahaan']));
    }

    public function store(Request $request)
    {
        $messages  = [
            'required' => 'Kolom harus diisi.',
            'string'   => 'Kolom harus berupa teks.',
            'max'      => 'Kolom maksimal :max kata.',
            'mimes'    => 'Format file harus jpg/png.',
        ];
        
        $validator = Validator::make($request->all(), [
            'nama_perusahaan'   => 'required',
            'alamat_perusahaan' => 'required',
            'no_tlp_perusahaan' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages()
            ]);
        } else {

            $nama_perusahaan   = $request->nama_perusahaan;
            $alamat_perusahaan = $request->alamat_perusahaan;
            $no_tlp_perusahaan = $request->no_tlp_perusahaan;

            // Buat objek Perusahaan dan simpan data jika memenuhi syarat
            $perusahaan                    = new Perusahaan;
            $perusahaan->nama_perusahaan   = $nama_perusahaan;
            $perusahaan->alamat_perusahaan = $alamat_perusahaan;
            $perusahaan->no_tlp_perusahaan = $no_tlp_perusahaan;
            $perusahaan->save();

            // Tambahkan aktivitas log
            \ActivityLog::addToLog('Menambah data perusahaan');

            // Kirim respons berhasil
            return response()->json([
                'status' => 200,
                'message' => 'Data perusahaan berhasil ditambahkan. '
            ]);
        }
    }

    public function edit($id)
    {
        $perusahaan = Perusahaan::find($id);
        return response()->json($perusahaan);
    }

    public function update($id, Request $request)
    {
        $messages  = [
            'required' => 'Kolom :attribute harus diisi.',
            'string'   => 'Kolom :attribute harus berupa huruf.',
            'numeric'  => 'Kolom :attribute harus berupa angka.',
            'alpha'    => 'Kolom :attribute harus berupa huruf.',
            'max'      => 'Kolom :attribute maksimal :max kata.',
        ];
        
        $validator = Validator::make($request->all(), [
            'nama_perusahaan'   => 'required|max:100',
            'alamat_perusahaan' => 'required',
            'no_tlp_perusahaan' => 'required|numeric'
        ],$messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            // dd($request->all());
            \ActivityLog::addToLog('Mengedit data perusahaan');

            $perusahaan                    = Perusahaan::find($id);
            $perusahaan->nama_perusahaan   = $request->nama_perusahaan;
            $perusahaan->alamat_perusahaan = $request->alamat_perusahaan;
            $perusahaan->no_tlp_perusahaan = $request->no_tlp_perusahaan;
            $perusahaan->save();

            return response()->json([
                'status'    => 200,
                'message'   => 'Sukses! Data perusahaan berhasil diupdate'
            ]);
        }
    }

    public function destroy($id)
    {
        $perusahaan = Perusahaan::find($id);

        \ActivityLog::addToLog('Menghapus data perusahaan');

        if ($perusahaan) {
            $perusahaan->delete();
            return response()->json([
                'status'    => 200,
                'message'   => 'Sukses! Data perusahaan berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'status'    => 404,
                'errors'    => 'Error! Data perusahaan tidak ditemukan'
            ]);
        }
    }
}
