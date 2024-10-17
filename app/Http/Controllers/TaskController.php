<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data Item
        $task      = Task::all();
        $user      = User::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($task)
                ->addColumn('user', function(Task $task) {
                    return $task->user->name;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-task"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            <a href="task/detail/' . $data->id . '" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                            </div>
                        </div>';
                    return $button;
                })
                ->rawColumns(['aksi', 'user'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('tasks.index', compact(['task', 'user']));
    }
}
