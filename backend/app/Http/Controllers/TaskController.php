<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = [
            [
                'id' => 1,
                'name' => '掃除する',
                'status' => 'Open',
                'description' => null,
            ]
        ];

        return response()->json($tasks);
    }

    public function show(): JsonResponse
    {
        $task = [
            'id' => 1,
            'name' => '掃除する',
            'status' => 'Open',
            'status_id' => 1,
            'description' => 'キッチンまわりの掃除をする',
        ];

        return response()->json($task);
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $request->validated() + ['id' => 1, 'status' => 'Open'];

        return response()->json($task, 201);
    }
}
