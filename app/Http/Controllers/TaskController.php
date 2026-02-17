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
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'priority'       => 'required|in:alta,media,baja',
            'status'         => 'required|in:backlog,en_progreso,testing,terminada',
            'estimated_time' => 'nullable|integer|min:1|max:9999',
            'estimated_unit' => 'nullable|required_with:estimated_time|in:minutos,horas,dias',
        ]);

        $project->tasks()->create($data);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Tarea añadida correctamente.');
    }

    public function update(Request $request, Project $project, Task $task)
    {
        abort_if($task->status === 'terminada', 403, 'No se puede editar una tarea terminada.');

        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'priority'       => 'required|in:alta,media,baja',
            'estimated_time' => 'nullable|integer|min:1|max:9999',
            'estimated_unit' => 'nullable|required_with:estimated_time|in:minutos,horas,dias',
        ]);

        $task->update($data);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Tarea actualizada correctamente.');
    }

    public function advanceStatus(Project $project, Task $task)
    {
        $next = $task->nextStatus();

        if ($next) {
            $task->update(['status' => $next]);
            $msg = $next === 'terminada'
                ? '¡Tarea marcada como terminada!'
                : 'Estado actualizado a "' . $next . '".';
        } else {
            $msg = 'La tarea ya está terminada.';
        }

        return redirect()->route('projects.show', $project)->with('success', $msg);
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Tarea eliminada.');
    }
}
