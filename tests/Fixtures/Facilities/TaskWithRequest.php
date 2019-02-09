<?php

namespace JeroenG\Facilitator\Tests\Fixtures\Facilities;

use JeroenG\Facilitator\Facility;

class TaskWithRequest extends Facility
{
    protected $model = \JeroenG\Facilitator\Tests\Fixtures\Models\TaskWithRequest::class;

    protected $formRequest = \JeroenG\Facilitator\Tests\Fixtures\Requests\FacilityRequest::class;

    protected $fields = [
        'checked' => 'checkbox',
    ];
}
