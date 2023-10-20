<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function createTask(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:100',
            'description' => 'required|string',
            'due_date'    => 'required|date',
        ]);

        $user = auth()->user();
        $data = [
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'due_date'    => $request->input('due_date'),
            'completed'   => 0,
        ];

        $task = $this->taskRepository->createTask($user, $data);

        return response()->json($task);
    }

    public function getTask(Request $request)
    {
        $user = auth()->user();
        $task = $this->taskRepository->getTasksByUserId($user->id);

        return response()->json($task);
    }

    public function editTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'due_date' => 'required|date'
        ]);

        $editedTask = $this->taskRepository->editTask($request->only([
            'title',
            'description',
            'due_date',
            'id'
        ]));

        return response()->json(['result' => $editedTask]);
    }

    public function deleteTask(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $deletedTask = $this->taskRepository->deleteTask($request->only(['id']));
        return response()->json(['result' => $deletedTask]);
    }

    public function markTask(Request $request)
    {
        $request->validate([
            'id'        => 'required',
            'completed' => 'required'
        ]);

        $markTask = $this->taskRepository->markTask($request->only(['id', 'completed']));
        return response()->json(['result' => $markTask]);
    }
}
