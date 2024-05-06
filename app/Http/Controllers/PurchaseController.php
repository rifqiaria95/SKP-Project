<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Karyawan;
use App\Models\Perusahaan;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data perusahaan
        $purchase   = PurchaseOrder::all();
        $user       = User::all();
        $item       = Item::all();
        $karyawan   = Karyawan::all();
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
                    <a href="javascript:void(0)" id="edit-purchase" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-purchase"><i class="fa-solid fa-pen"></i></a>
                    <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                    <a href="purchaseorder/detail/' . $data->id . '" name="detail" class="detail btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                    </div>
                </div>';
                return $button;
            })
            ->rawColumns(['item', 'user', 'aksi', 'karyawan'])
            ->addIndexColumn()
            ->toJson();
        }

        return view('purchaseorder.index', compact(
        [
            'purchase',
            'user',
            'item',
            'vendor',
            'perusahaan',
            'karyawan',
        ]));
    }

    public function store(Request $request)
    {
        Log::info($request->all());

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
            $purchase->ppn           = $request->ppn;
            $purchase->grand_total   = $request->grand_total;
            $purchase->sub_total     = $request->sub_total;
            $purchase->pic_1         = $request->pic_1;
            $purchase->pic_2         = $request->pic_2;
            $purchase->user_id       = auth()->user()->id;
            $purchase->vendor_id     = $request->vendor_id;
            $purchase->perusahaan_id = $request->perusahaan_id;
            $purchase->save();


            foreach ($request->item as $key => $itemId) {
                $item = Item::find($itemId);

                $purchase->item()->attach($item->id, [
                    'quantity'    => $request->quantity[$key],
                    'total_harga' => $request->total_harga[$key],
                ]);
            }

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
        $purchase = PurchaseOrder::with('item')->find($id);
        
        if (!$purchase) {
            return response()->json(['error' => 'Purchase order not found'], 404);
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

            $purchase = PurchaseOrder::find($id);
            $purchase->nomor_po      = $request->nomor_po;
            $purchase->nama_po       = $request->nama_po;
            $purchase->tanggal       = $request->tanggal;
            $purchase->status        = $request->status;
            $purchase->ppn           = $request->ppn;
            $purchase->grand_total   = $request->grand_total;
            $purchase->sub_total     = $request->sub_total;
            $purchase->pic_1         = $request->pic_1;
            $purchase->pic_2         = $request->pic_2;
            $purchase->user_id       = auth()->user()->id;
            $purchase->vendor_id     = $request->vendor_id;
            $purchase->perusahaan_id = $request->perusahaan_id;
            $purchase->save();

            // Proses item yang dikirim dari frontend
            if ($request->has('item')) {
                foreach ($request->item as $key => $itemId) {
                    $item = Item::find($itemId);

                    // Jika item sudah ada, update pivot, jika tidak, attach item baru
                    if ($purchase->item->contains($item->id)) {
                        $purchase->item()->updateExistingPivot($item->id, [
                            'quantity'    => $request->quantity[$key],
                            'total_harga' => $request->total_harga[$key],
                        ]);
                    } else {
                        $purchase->item()->attach($item->id, [
                            'quantity'    => $request->quantity[$key],
                            'total_harga' => $request->total_harga[$key],
                        ]);
                    }
                }
            }

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

    public function deleteitem($idpurchase, $iditem)
    {
        $purchase = PurchaseOrder::find($idpurchase);
        $purchase->item()->detach($iditem);

        return response()->json($purchase);
    }

    public function detailPurchase($id)
    {
        $purchase   = PurchaseOrder::find($id);
        $item       = Item::all();
        $vendor     = Vendor::all();
        // $vendorNote = Vendor::first()->note;

        return view('purchaseorder.detail', compact(['purchase', 'item', 'vendor']));
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
