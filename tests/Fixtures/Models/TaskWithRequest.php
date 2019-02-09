<?php

namespace JeroenG\Facilitator\Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Model;
use JeroenG\Facilitator\Concerns\HasFacility;
use JeroenG\Facilitator\Tests\Fixtures\Facilities\TaskWithRequest as FacilityClass;

class TaskWithRequest extends Model
{
    use HasFacility;

    protected $facilityClass = FacilityClass::class;

    protected $table = 'tasks';

    public $fillable = ['title', 'content', 'checked'];

    public $casts = [
        'checked' => 'boolean',
    ];
}
