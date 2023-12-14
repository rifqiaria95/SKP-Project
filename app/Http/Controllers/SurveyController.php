<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Survey;

class SurveyController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data survey
        $survey      = Survey::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($survey)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                   <div class="btn-group me-2" role="group" aria-label="First group">
                       <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-survey"><i class="fa-solid fa-pen"></i></a>
                       <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                       <a href="survey/' . $data->id . '/detail" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                   </div>
               </div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('survey.index', compact(['survey']));
    }

    public function create() {
		$survey      = Survey::all();

		return view('survey.create', compact(['survey']));
	}

    public function store(Request $request)
    {
        // dd($request->all());
        $messages  = [
            'required'  =>  'Kolom :attribute harus diisi.',
            'string'    =>  'Kolom :attribute harus berupa teks.',
            'max'       =>  'Kolom :attribute maksimal :max kata.'
        ];

        $validator = Validator::make($request->all(), [
            'username'         => 'required|string|max:30',
            'experience_score' => 'required',
            'email'            => 'required|email',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);

        } else {
            \ActivityLog::addToLog('Menambah data survey');

            $survey                   = new Survey;
            $survey->username         = $request->username;
            $survey->email            = $request->email;
            $survey->experience_score = $request->experience_score;
            $survey->description      = $request->description;
            $survey->suggestion       = $request->suggestion;
            $survey->recommend        = $request->recommend;
            $survey->arrival          = $request->arrival;
            $survey->service          = $request->service;
            $survey->room             = $request->room;
            $survey->fb               = $request->fb;
            $survey->facilities       = $request->facilities;
            $survey->cleanliness      = $request->cleanliness;
            $survey->atmosphere       = $request->atmosphere;
            $survey->checkout         = $request->checkout;
            $survey->wifi             = $request->wifi;
            $survey->value            = $request->value;
            $survey->room_number      = $request->room_number;
            $survey->type             = $request->type;
            $survey->country          = $request->country;
            $survey->save();

            return response()->json([
                'status'    => 200,
                'message'   => 'Berhasil, ditambahkan pada tanggal: ',
            ]);
        }
    }
}
