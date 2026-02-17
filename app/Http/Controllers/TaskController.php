<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => 'required|in:alta,media,baja',
            'status'      => 'required|in:backlog,en_progreso,testing,terminada',
        ]);

        $project->tasks()->create($data);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Tarea añadida correctamente.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Tarea eliminada.');
    }
}
