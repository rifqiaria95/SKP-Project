<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data perusahaan
        $purchase = PurchaseOrder::all();
        $user     = User::all();
        $item     = Item::all();
        $vendor   = Vendor::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($purchase)
            ->addColumn('purchase', function(PurchaseOrder $purchase) {
                return $purchase->user->name;
            })
            ->addColumn('aksi', function ($data) {
                $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-purchase"><i class="fa-solid fa-pen"></i></a>
                    <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                    <a href="purchase/view/' . $data->id . '" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                    </div>
                </div>';
                return $button;
            })
            ->rawColumns(['item', 'user', 'aksi'])
            ->addIndexColumn()
            ->toJson();
        }

        return view('purchaseorder.index', compact(['purchase', 'user', 'item', 'vendor']));
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
            'nama_po'     => 'required'
        ],$messages);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages()
            ]);
        } else {

            $nomor_po      = $request->nomor_po;
            $nama_po       = $request->nama_po;
            $tanggal       = $request->tanggal;
            $harga         = $request->harga;
            $total_harga   = $request->total_harga;
            $ppn           = $request->ppn;
            $grand_total   = $request->grand_total;
            $quantity      = $request->quantity;
            $status        = $request->status;
            $user_id       = $request->user_id;
            $item_id       = $request->item_id;
            $vendor_id     = $request->vendor_id;
            $perusahaan_id = $request->perusahaan_id;
            
            // Buat objek Vendor dan simpan data jika memenuhi syarat
            $purchase = new PurchaseOrder;
            $purchase->nomor_po      = $nomor_po;
            $purchase->nama_po       = $nama_po;
            $purchase->tanggal       = $tanggal;
            $purchase->harga         = $harga;
            $purchase->total_harga   = $total_harga;
            $purchase->ppn           = $ppn;
            $purchase->grand_total   = $grand_total;
            $purchase->quantity      = $quantity;
            $purchase->status        = $status;
            $purchase->user_id       = $user_id;
            $purchase->ppn           = $vendor_id;
            $purchase->perusahaan_id = $perusahaan_id;
            $purchase->save();

            $purchaseId = $purchaseId->id;

            $item = new Item();
            // Lakukan pengisian atribut-atribut Item
            $item->item_id     = $item_id;
            $item->purchase_id = $purchase_id;
            $item->save();
            $purchaseOrder->item()->attach($item->id);

            // Tambahkan aktivitas log
            \ActivityLog::addToLog('Menambah data PO');

            // Kirim respons berhasil
            return response()->json([
                'status' => 200,
                'message' => 'Data PO berhasil ditambahkan. '
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