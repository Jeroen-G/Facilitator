<?php

namespace JeroenG\Facilitator\Tests\Unit;

use JeroenG\Facilitator\Facility;
use JeroenG\Facilitator\Tests\TestCase;
use JeroenG\Facilitator\Tests\Fixtures\Models\Task;

class ManagerTest extends TestCase
{
    public function test_a_model_is_assigned_a_facility()
    {
        $task = new Task();
        $this->assertTrue($task->getFacility() instanceof Facility);
    }
}
