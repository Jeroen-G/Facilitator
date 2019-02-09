<?php

namespace JeroenG\Facilitator\Tests\Fixtures\Facilities;

use JeroenG\Facilitator\Facility;

class Task extends Facility
{
    protected $model = \JeroenG\Facilitator\Tests\Fixtures\Models\Task::class;

    protected $fields = [
        'checked' => 'checkbox',
    ];
}
