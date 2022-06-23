<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = [
            [
                'name' => '掃除する',
                'status' => 'Open',
            ]
        ];

        return response()->json($tasks);
    }
}
