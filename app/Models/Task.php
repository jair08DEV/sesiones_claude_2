<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id', 'title', 'description',
        'priority', 'status',
        'estimated_time', 'estimated_unit',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Flujo de estados en orden
    const STATUS_FLOW = ['backlog', 'en_progreso', 'testing', 'terminada'];

    public function nextStatus(): ?string
    {
        $idx = array_search($this->status, self::STATUS_FLOW);
        return self::STATUS_FLOW[$idx + 1] ?? null;
    }

    public function isFinished(): bool
    {
        return $this->status === 'terminada';
    }
}
