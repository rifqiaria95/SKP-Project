<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data Item
        $item      = Item::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($item)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-item"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            <a href="item/detail/' . $data->id . '" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                            </div>
                        </div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('item.index', compact(['item']));
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
            'nama_item'        => 'required|max:100',
            'spesifikasi_item' => 'required',
            'harga'            => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {

            // Process note data
            $note = $request->input('note');

            // Remove <ol> and <li> tags
            $note = strip_tags($note, '<li>');

            // Split the note into lines
            $lines = explode("</li>", $note);

            // Format the list items with numbers
            $formattedNote = '';
            foreach ($lines as $index => $line) {
                // Remove leading <li> tag
                $line = ltrim($line, '<li>');
                // Add number and line break
                $formattedNote .= ($index + 1) . '. ' . $line . "\n";
            }

            // Create or update item with the modified note
            $item                   = new Item;
            $item->nama_item        = $request->nama_item;
            $item->spesifikasi_item = $request->spesifikasi_item;
            $item->harga            = $request->harga;
            $item->note             = $formattedNote;
            $item->save();

            // Log activity
            \ActivityLog::addToLog('Menambah data item');

            // Response
            return response()->json([
                'status' => 200,
                'message' => 'Data item berhasil ditambahkan.'
            ]);
        }
    }
}
