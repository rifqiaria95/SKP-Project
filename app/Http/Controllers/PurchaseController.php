<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data perusahaan
        $purchase   = PurchaseOrder::all();
        $user       = User::all();
        $item       = Item::all();
        $vendor     = Vendor::all();
        $perusahaan = Perusahaan::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($purchase)
            ->addColumn('user', function(PurchaseOrder $purchase) {
                return $purchase->user->name;
            })
            ->addColumn('aksi', function ($data) {
                $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-purchase"><i class="fa-solid fa-pen"></i></a>
                    <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                    <a href="purchase/detail/' . $data->id . '" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                    </div>
                </div>';
                return $button;
            })
            ->rawColumns(['item', 'user', 'aksi'])
            ->addIndexColumn()
            ->toJson();
        }

        return view('purchaseorder.index', compact(
        [
            'purchase',
            'user',
            'item',
            'vendor',
            'perusahaan'
        ]));
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
            'nomor_po' => 'required|max:100',
            'nama_po'  => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages()
            ]);
        } else {

            $purchase                = new PurchaseOrder;
            $purchase->nomor_po      = $request->nomor_po;
            $purchase->nama_po       = $request->nama_po;
            $purchase->tanggal       = $request->tanggal;
            $purchase->status        = $request->status;
            $purchase->user_id       = auth()->user()->id;
            $purchase->vendor_id     = $request->vendor_id;
            $purchase->perusahaan_id = $request->perusahaan_id;
            $purchase->save();

            // foreach ($purchase as $prc) {
            //     $purchase->item()->attach($request->item, [
            //         'item_id'           => $prc->item_id,
            //         'harga'             => $prc->harga,
            //         'total_harga'       => $prc->total_harga,
            //         'ppn'               => $prc->ppn,
            //         'grand_total'       => $prc->grand_total,
            //         'quantity'          => $prc->quantity
            //     ]); // Jika ada atribut tambahan pada pivot
            // }
            $purchase->item()->attach($request->item);

            // Tambahkan aktivitas log
            \ActivityLog::addToLog('Menambah data PO');

            // Kirim respons berhasil
            return response()->json([
                'status' => 200,
                'message' => 'Data PO berhasil ditambahkan. '
            ]);
        }
    }

    public function edit($id)
    {
        $purchase = PurchaseOrder::find($id);
        $item     = Item::find($id);
        foreach ($purchase->item as $itm) {
            $itm->pivot->item_purchase_order;
        }
        
        return response()->json($purchase);
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
            'nomor_po' => 'required|max:100',
            'nama_po'  => 'required'
        ],$messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            \ActivityLog::addToLog('Mengedit data PO');

            $item                    = Item::find($id);
            $purchase                = PurchaseOrder::find($id);
            $purchase->nomor_po      = $request->nomor_po;
            $purchase->nama_po       = $request->nama_po;
            $purchase->tanggal       = $request->tanggal;
            $purchase->harga         = $request->harga;
            $purchase->total_harga   = $request->total_harga;
            $purchase->ppn           = $request->ppn;
            $purchase->grand_total   = $request->grand_total;
            $purchase->quantity      = $request->quantity;
            $purchase->status        = $request->status;
            $purchase->user_id       = auth()->user()->id;
            $purchase->vendor_id     = $request->vendor_id;
            $purchase->perusahaan_id = $request->perusahaan_id;
            $purchase->save();
            
            $purchase->item()->updateExistingPivot($id, [
                'item_id' => $request->item_id
            ]);

            return response()->json([
                'status'    => 200,
                'message'   => 'Sukses! Data PO berhasil diupdate'
            ]);
        }
    }

    
    public function destroy($id)
    {
        $purchase = PurchaseOrder::find($id);
        $item     = Item::find($id);

        $purchase->item()->detach();

        \ActivityLog::addToLog('Menghapus data purchase');

        if ($purchase) {
            $purchase->delete();
            return response()->json([
                'status'    => 200,
                'message'   => 'Sukses! Data purchase berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'status'    => 404,
                'errors'    => 'Error! Data purchase tidak ditemukan'
            ]);
        }
    }

    public function getDetail($id)
    {
        $vendor = Vendor::find($id);
        return response()->json($vendor);
    
    }

    public function getDetailItem($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    
    }

}
