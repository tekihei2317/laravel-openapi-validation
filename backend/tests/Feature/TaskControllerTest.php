<?php

namespace Tests\Feature;

use Tests\TestCase;
use Spectator\Spectator;

class TaskControllerTest extends TestCase
{
    private string $resourcePath = '/api/tasks';

    public function setUp(): void
    {
        parent::setUp();

        Spectator::using('task-api.yaml');
    }

    /**
     * @test
     */
    public function index_タスク一覧が取得できること()
    {
        $response = $this->get($this->resourcePath);

        $response->assertOk();
        $response->assertJson([
            [
                'id' => 1,
                'name' => '掃除する',
                'status' => 'Open'
            ]
        ]);
    }

    /**
     * @test
     */
    public function index_レスポンスの形式が正しいこと()
    {
        $this->get($this->resourcePath)->assertValidResponse(200);
    }

    /**
     * @test
     */
    public function show_タスクが取得できること()
    {
        $response = $this->get("{$this->resourcePath}/1");

        $response->assertOk();
        $response->assertJson([
            'id' => 1,
            'name' => '掃除する',
            'status' => 'Open',
            'status_id' => 1,
            'description' => 'キッチンまわりの掃除をする',
        ]);
    }

    /**
     * @test
     */
    public function show_レスポンスの形式が正しいこと()
    {
        $this->get("{$this->resourcePath}/1")->assertValidRequest()->assertValidResponse(200);
    }

    /**
     * @test
     */
    public function store_タスクが登録できること()
    {
        $data = [
            'name' => '掃除する',
            'status_id' => 1,
            'description' => 'キッチンまわりの掃除をする',
        ];

        $this->postJson($this->resourcePath, $data)->assertValidRequest()->assertValidResponse(201);
    }
}
