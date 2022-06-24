<?php

namespace Tests\Feature;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Osteel\OpenApi\Testing\Validator;
use Osteel\OpenApi\Testing\ValidatorBuilder;

class TaskControllerTestV2 extends TestCase
{
    private string $resourcePath = '/api/tasks';
    private Validator $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = ValidatorBuilder::fromYaml('/work/task-api/reference/task-api.yaml')->getValidator();
    }

    /** @test */
    public function index_タスク一覧を取得できること()
    {
        $response = $this->getJson($this->resourcePath);

        $this->assertTrue(
            $this->isResponseValid($response, '/tasks', 'get')
        );
    }

    /** @test */
    public function show_タスクを取得できること()
    {
        $response = $this->getJson("{$this->resourcePath}/1");

        $this->assertTrue(
            $this->isResponseValid($response, '/tasks/{task_id}', 'get')
        );
    }

    /** @test */
    public function store_タスクを登録できること()
    {
        $data = [
            'name' => '掃除する',
            'status_id' => 1,
            'description' => 'キッチンまわりの掃除をする',
        ];

        $response = $this->postJson($this->resourcePath, $data);

        $this->assertTrue(
            $this->isResponseValid($response, '/tasks', 'post')
        );
    }

    /** @test */
    public function update_タスクを更新できること()
    {
        $data = [
            'name' => '掃除する',
            'status_id' => 1,
            'description' => 'キッチンまわりの掃除をする',
        ];

        $response = $this->putJson("{$this->resourcePath}/1", $data);

        $this->assertTrue(
            $this->isResponseValid($response, '/tasks/{task_id}', 'put')
        );
    }

    /** @test */
    public function delete_タスクを削除できること()
    {
        $response = $this->deleteJson("{$this->resourcePath}/1");

        $this->assertTrue($this->isResponseValid($response, '/tasks/{task_id}', 'delete'));
    }

    private function isResponseValid(TestResponse $response, string $path, string $method): bool
    {
        return $this->validator->validate($response->baseResponse, $path, $method);
    }
}
