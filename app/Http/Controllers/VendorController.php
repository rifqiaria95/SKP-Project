<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data karyawan
        $vendor      = Vendor::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($vendor)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-vendor"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            <a href="vendor/profile/' . $data->id . '" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                            </div>
                        </div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('vendor.index', compact(['vendor']));
    }

    public function store(Request $request)
    {
        $messages  = [
            'required' => 'Kolom :attribute harus diisi.',
            'string'   => 'Kolom :attribute harus berupa teks.',
            'numeric'  => 'Kolom :attribute harus berupa angka.',
            'alpha'    => 'Kolom :attribute harus berupa teks.',
            'max'      => 'Kolom :attribute maksimal :max kata.',
        ];
        
        $validator = Validator::make($request->all(), [
            'nama_vendor' => 'required|max:100',
            'alamat'      => 'required',
            'no_tlp'      => 'required|numeric',
            'pic'         => 'required|string|max:30',
            'note'        => 'required'
        ],$messages);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages()
            ]);
        } else {

            $nama_vendor       = $request->nama_vendor;
            $alamat            = $request->alamat;
            $no_tlp            = $request->no_tlp;
            $pic               = $request->pic;
            $jabatan_pic       = $request->jabatan_pic;
            $note              = $request->note;

            // Buat objek Vendor dan simpan data jika memenuhi syarat
            $vendor = new Vendor;
            $vendor->nama_vendor = $nama_vendor;
            $vendor->alamat      = $alamat;
            $vendor->no_tlp      = $no_tlp;
            $vendor->pic         = $pic;
            $vendor->jabatan_pic = $jabatan_pic;
            $vendor->note        = $note;
            $vendor->save();

            // Tambahkan aktivitas log
            \ActivityLog::addToLog('Menambah data vendor');

            // Kirim respons berhasil
            return response()->json([
                'status' => 200,
                'message' => 'Data vendor berhasil ditambahkan. '
            ]);
        }
    }

    public function edit($id)
    {
        $vendor = Vendor::find($id);
        return response()->json($vendor);
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
            'nama_vendor' => 'required|max:100',
            'alamat'      => 'required',
            'no_tlp'      => 'required|numeric',
            'pic'         => 'required|string|max:100',
            'note'        => 'required'
        ],$messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            // dd($request->all());
            \ActivityLog::addToLog('Mengedit data vendor');

            $vendor              = Vendor::find($id);
            $vendor->nama_vendor = $request->nama_vendor;
            $vendor->alamat      = $request->alamat;
            $vendor->no_tlp      = $request->no_tlp;
            $vendor->pic         = $request->pic;
            $vendor->jabatan_pic = $request->jabatan_pic;
            $vendor->note        = $request->note;
            $vendor->save();

            return response()->json([
                'status'    => 200,
                'message'   => 'Sukses! Data vendor berhasil diupdate'
            ]);
        }
    }


    public function destroy($id)
    {
        $vendor = Vendor::find($id);

        \ActivityLog::addToLog('Menghapus data vendor');

        if ($vendor) {
            $vendor->delete();
            return response()->json([
                'status'    => 200,
                'message'   => 'Sukses! Data vendor berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'status'    => 404,
                'errors'    => 'Error! Data vendor tidak ditemukan'
            ]);
        }
    }
}
