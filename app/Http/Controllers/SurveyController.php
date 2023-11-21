<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends Controller
{
    public function index()
    {
        return view('survey.index');
    }

    public function create() {
		$survey      = Survey::all();

		return view('survey.create', compact(['survey']));
	}
}
