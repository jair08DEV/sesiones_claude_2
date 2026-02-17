<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::withCount([
            'tasks',
            'tasks as completed_tasks_count' => fn($q) => $q->where('status', 'terminada'),
            'tasks as active_tasks_count'    => fn($q) => $q->where('status', 'en_progreso'),
        ])->latest()->get();

        $stats = [
            'total'       => $projects->count(),
            'terminados'  => $projects->filter(fn($p) => $p->tasks_count > 0 && $p->tasks_count === $p->completed_tasks_count)->count(),
            'en_progreso' => $projects->filter(fn($p) => $p->active_tasks_count > 0)->count(),
            'vencidos'    => $projects->filter(fn($p) => $p->deadline->isPast())->count(),
        ];

        return view('home', compact('projects', 'stats'));
    }
}
