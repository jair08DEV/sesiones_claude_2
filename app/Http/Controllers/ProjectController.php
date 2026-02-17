<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline'    => 'required|date',
        ]);

        $project = Project::create($data);

        return redirect()->route('projects.show', $project)
                         ->with('success', '¡Proyecto creado! Ahora añade las tareas.');
    }

    public function show(Project $project)
    {
        $tasks = $project->tasks()->latest()->get();

        return view('projects.show', compact('project', 'tasks'));
    }
}
