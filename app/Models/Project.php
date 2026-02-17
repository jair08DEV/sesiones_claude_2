<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'deadline', 'status'];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
