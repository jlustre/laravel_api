<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Retrieve all records
    public function index() {
        return TaskResource::collection(Task::all());
    }

    // Retrieve a record
    public function show(Task $task) {
        return TaskResource::make($task);
    }

    // Create a record
    public function store(StoreTaskRequest $request) {
        $task = Task::create($request->validated());
        return TaskResource::make($task);
    }

    // Update a record
    public function update(UpdateTaskRequest $request, Task $task) {
        $task->update($request->validated());
        return TaskResource::make($task);
    }

    // Delete a record
    public function destroy(Task $task) {
        $task->delete();
        return response()->noContent();
    }
}