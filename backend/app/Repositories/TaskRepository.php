<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function getTasksByUserId($userId)
    {
        return Task::where('user_id', $userId)->get();
    }

    public function createTask($user, $data)
    {
        $task = new Task($data);
        $task->user()->associate($user);
        $task->save();
        return $task;
    }

    public function editTask($data)
    {
        $task = Task::find($data['id']);

        if (!$task) {
            return false;
        }

        $task->update($data);
        return $task;
    }

    public function deleteTask($taskId)
    {
        return Task::where('id', $taskId)->delete();
    }

    public function markTask($data)
    {
        $task = Task::find($data['id']);

        if (!$task) {
            return false;
        }

        $task->update($data);
        return $task;
    }
}
