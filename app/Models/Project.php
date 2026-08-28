<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'description', 'image',
        'tech_stack', 'workflow_steps', 'featured', 'position',
    ];

    protected $casts = [
        'workflow_steps' => 'array',
        'featured' => 'boolean',
    ];
}
