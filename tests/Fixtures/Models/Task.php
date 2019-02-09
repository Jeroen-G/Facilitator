<?php

namespace JeroenG\Facilitator\Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Model;
use JeroenG\Facilitator\Concerns\HasFacility;

class Task extends Model
{
    use HasFacility;

    public $fillable = ['title', 'content', 'checked'];

    public $casts = [
        'checked' => 'boolean',
    ];
}
