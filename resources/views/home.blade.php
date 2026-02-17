@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Flash --}}
    @if (session('status') || session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') ?? session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Cabecera --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-0">Dashboard</h2>
            <p class="text-muted mb-0">Bienvenido, {{ Auth::user()->name }}</p>
        </div>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                <path d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>
            Crear Proyecto
        </a>
    </div>

    {{-- Tarjetas de resumen --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-primary bg-opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0d6efd" viewBox="0 0 16 16">
                            <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Total proyectos</p>
                        <h4 class="fw-bold mb-0">{{ $stats['total'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-success bg-opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#198754" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Terminados</p>
                        <h4 class="fw-bold mb-0">{{ $stats['terminados'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-warning bg-opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffc107" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">En progreso</p>
                        <h4 class="fw-bold mb-0">{{ $stats['en_progreso'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-danger bg-opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#dc3545" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Vencidos</p>
                        <h4 class="fw-bold mb-0">{{ $stats['vencidos'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Listado de proyectos --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0 fw-semibold">Mis proyectos</h5>
            @if ($projects->isNotEmpty())
                <span class="badge bg-primary rounded-pill">{{ $projects->count() }}</span>
            @endif
        </div>

        @if ($projects->isEmpty())
            {{-- Empty state --}}
            <div class="card-body text-center py-5 text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor"
                     class="bi bi-folder-plus mb-3 opacity-25" viewBox="0 0 16 16">
                    <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
                    <path d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5"/>
                </svg>
                <h6 class="fw-semibold mb-1">Sin proyectos aún</h6>
                <p class="small mb-3">Crea tu primer proyecto y empieza a organizar tus tareas.</p>
                <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm px-4">
                    Crear primer proyecto
                </a>
            </div>

        @else
            {{-- Tabla --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Proyecto</th>
                            <th>Fecha límite</th>
                            <th class="text-center">Tareas</th>
                            <th class="text-center">Progreso</th>
                            <th class="text-center">Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            @php
                                $pct = $project->tasks_count > 0
                                    ? round(($project->completed_tasks_count / $project->tasks_count) * 100)
                                    : 0;
                                $isOverdue  = $project->deadline->isPast();
                                $isDone     = $project->tasks_count > 0 && $project->tasks_count === $project->completed_tasks_count;
                                $statusLabel = $isDone ? 'Terminado' : ($isOverdue ? 'Vencido' : 'Activo');
                                $statusClass = $isDone ? 'success' : ($isOverdue ? 'danger' : 'primary');
                            @endphp
                            <tr>
                                <td class="ps-4">
                                    <a href="{{ route('projects.show', $project) }}"
                                       class="fw-semibold text-decoration-none text-dark">
                                        {{ $project->name }}
                                    </a>
                                    @if ($project->description)
                                        <p class="text-muted small mb-0">
                                            {{ Str::limit($project->description, 60) }}
                                        </p>
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    <span class="{{ $isOverdue && !$isDone ? 'text-danger fw-semibold' : 'text-muted' }}">
                                        {{ $project->deadline->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary rounded-pill">
                                        {{ $project->tasks_count }}
                                    </span>
                                </td>
                                <td style="min-width: 120px">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1" style="height: 6px">
                                            <div class="progress-bar bg-{{ $statusClass }}"
                                                 style="width: {{ $pct }}%"></div>
                                        </div>
                                        <span class="small text-muted">{{ $pct }}%</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $statusClass }} bg-opacity-10 text-{{ $statusClass }} border border-{{ $statusClass }} border-opacity-25">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="{{ route('projects.show', $project) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection
