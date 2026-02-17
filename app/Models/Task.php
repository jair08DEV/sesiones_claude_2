<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['project_id', 'title', 'description', 'priority', 'status'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public static array $priorityLabels = [
        'alta'  => 'Alta',
        'media' => 'Media',
        'baja'  => 'Baja',
    ];

    public static array $statusLabels = [
        'backlog'     => 'Backlog',
        'en_progreso' => 'En progreso',
        'testing'     => 'Testing',
        'terminada'   => 'Terminada',
    ];
}
