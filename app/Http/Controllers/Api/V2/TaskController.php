<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    // Retrieve all records
    public function index() {
        return TaskResource::collection(auth()->user()->tasks()->get());
    }

    // Retrieve a record
    public function show(Task $task) {
        return TaskResource::make($task);
    }

    // Create a record
    public function store(StoreTaskRequest $request) {
        $task = $request->user()->task()->create($request->validated());
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