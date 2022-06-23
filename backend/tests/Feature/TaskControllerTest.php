<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    private string $resourcePath = '/api/tasks';

    public function setUp(): void
    {
        parent::setUp();
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
                'name' => '掃除する',
                'status' => 'Open'
            ]
        ]);
    }
}
