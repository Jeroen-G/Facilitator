<?php

namespace JeroenG\Facilitator\Tests;

use JeroenG\Facilitator\Tests\Fixtures\Models\Task;

class PreTest extends TestCase
{
    public function test_task_model_is_decorated()
    {
        $task = Task::firstOrFail();
        $this->assertCreated('tasks', $task);
    }
}
