<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user     = Auth::user();
        $userRole = $user->role;

        // Ambil semua task jika user adalah owner, atau hanya task yang dia buat jika bukan owner
        if ($userRole === 'owner') {
            $tasks = Task::all();  // Ambil semua task untuk owner
        } else {
            $tasks = Task::where('user_id', $user->id)->get();  // Hanya ambil task milik user yang sedang login
        }

        // Periksa apakah tugas sudah melewati deadline
        foreach ($tasks as $task) {
            $task->is_overdue = Carbon::parse($task->deadline)->isPast(); // true jika deadline telah lewat
        }

        if ($request->ajax()) {
            return datatables()->of($tasks)
                ->addColumn('deadline', function(Task $task) {
                    return $task->deadline->isoFormat('D MMMM Y');
                })
                ->addColumn('priority', function(Task $task) {
                    if ($task->priority === 'Low') {
                        return '<span class="badge bg-label-secondary">Low</span>';
                    } else if ($task->priority === 'Important') {
                        return '<span class="badge bg-label-warning">Important</span>';
                    } else {
                        return '<span class="badge bg-label-danger">High Priority</span>';
                    }
                })
                ->addColumn('task_status', function(Task $task) {
                    if ($task->task_status === 'On Progress') {
                        return '<span class="badge bg-label-primary">On Progress</span>';
                    } else if ($task->task_status === 'Unfinished') {
                        return '<span class="badge bg-label-warning">Unfinished</span>';
                    } else {
                        return '<span class="badge bg-label-success">Finished</span>';
                    }
                })
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
                ->rawColumns(['aksi', 'user', 'deadline', 'priority', 'task_status'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('tasks.index', compact('tasks', 'user', 'userRole'));
    }


    public function store(Request $request)
    {
        Log::info($request->all());

        // Ambil role dari user yang sedang login
        $userRole = Auth::user()->role;

        // Pesan error khusus
        $messages  = [
            'required'       => 'Kolom :attribute harus diisi.',
            'string'         => 'Kolom :attribute harus berupa teks.',
            'numeric'        => 'Kolom :attribute harus berupa angka.',
            'alpha'          => 'Kolom :attribute harus berupa teks.',
            'max'            => 'Kolom :attribute maksimal :max kata.',
            'after_or_equal' => 'Tidak boleh isi tanggal yang sudah lewat.',
        ];
        
        // Tentukan aturan validasi berdasarkan role
        $rules = [
            'title'       => 'required|max:100',
            'description' => 'required',
            'priority'    => 'required',
            'task_status' => 'required',
            'deadline'    => 'required', // Rule default
        ];

        // Jika role user bukan 'owner', tambahkan rule after_or_equal:today
        if ($userRole != 'owner') {
            $rules['deadline'] .= '|after_or_equal:today';
        }

        // Lakukan validasi terlebih dahulu
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages()
            ]);
        }

        // Setelah validasi berhasil, ubah format deadline dari "15 Oct 2024" ke "Y-m-d"
        $formattedDeadline = Carbon::createFromFormat('d M Y', $request->deadline)->format('Y-m-d');

        // Proses penyimpanan task
        $task              = new Task;
        $task->title       = $request->title;
        $task->description = $request->description;
        $task->deadline    = $formattedDeadline;  // Format sudah diubah
        $task->priority    = $request->priority;
        $task->task_status = $request->task_status;
        $task->user_id     = auth()->user()->id;
        $task->save();

        // Tambahkan aktivitas log
        \ActivityLog::addToLog('Menambah Tugas Baru');

        // Kirim respons berhasil
        return response()->json([
            'status'  => 200,
            'message' => 'Task Has Been Added!'
        ]);
    }
    

    public function edit($id)
    {
        $task = Task::find($id);
        
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function update($id, Request $request)
    {
        Log::info($request->all());

        // Ambil role dari user yang sedang login
        $userRole = Auth::user()->role;

        // Pesan error khusus
        $messages  = [
            'required'       => 'Kolom :attribute harus diisi.',
            'string'         => 'Kolom :attribute harus berupa teks.',
            'numeric'        => 'Kolom :attribute harus berupa angka.',
            'alpha'          => 'Kolom :attribute harus berupa teks.',
            'max'            => 'Kolom :attribute maksimal :max kata.',
            'after_or_equal' => 'Tidak boleh isi tanggal yang sudah lewat.',
        ];
        
        // Tentukan aturan validasi berdasarkan role
        $rules = [
            'title'       => 'required|max:100',
            'description' => 'required',
            'priority'    => 'required',
            'task_status' => 'required',
            'deadline'    => 'required', // Rule default
        ];

        // Jika role user bukan 'owner', tambahkan rule after_or_equal:today
        if ($userRole != 'owner') {
            $rules['deadline'] .= '|after_or_equal:today';
        }

        // Lakukan validasi terlebih dahulu
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages()
            ]);
        }

        // Setelah validasi berhasil, ubah format deadline dari "15 Oct 2024" ke "Y-m-d"
        $formattedDeadline = Carbon::createFromFormat('d M Y', $request->deadline)->format('Y-m-d');

        \ActivityLog::addToLog('Mengedit Tugas');

        $task              = Task::find($id);
        $task->title       = $request->title;
        $task->description = $request->description;
        $task->deadline    = $formattedDeadline;     // Format sudah diubah
        $task->priority    = $request->priority;
        $task->task_status = $request->task_status;
        $task->save();

        return response()->json([
            'status'    => 200,
            'message'   => 'Success! Task has been updated'
        ]);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        \ActivityLog::addToLog('Menghapus taskk');

        if ($task) {
            $task->delete();
            return response()->json([
                'status'    => 200,
                'message'   => 'Task has been deleted'
            ]);
        } else {
            return response()->json([
                'status'    => 404,
                'errors'    => 'Error! Task not found'
            ]);
        }
    }

}
