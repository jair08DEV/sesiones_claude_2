@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active">{{ $project->name }}</li>
        </ol>
    </nav>

    {{-- Flash --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Cabecera del proyecto --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex align-items-start justify-content-between gap-3">
            <div>
                <h3 class="fw-bold mb-1">{{ $project->name }}</h3>
                @if ($project->description)
                    <p class="text-muted mb-2">{{ $project->description }}</p>
                @endif
                <span class="badge bg-secondary">
                    Fecha límite: {{ $project->deadline->format('d/m/Y') }}
                </span>
            </div>
            <div class="text-end text-nowrap">
                <span class="d-block fw-bold fs-4">{{ $tasks->count() }}</span>
                <span class="text-muted small">{{ Str::plural('tarea', $tasks->count()) }}</span>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- Columna izquierda: formulario nueva tarea --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold">Añadir tarea</h6>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('tasks.store', $project) }}">
                        @csrf

                        {{-- Título --}}
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold small">
                                Título <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="title" name="title"
                                   value="{{ old('title') }}"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Ej. Diseñar landing page" autofocus>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-3">
                            <label for="task_description" class="form-label fw-semibold small">
                                Descripción <span class="text-muted fw-normal">(opcional)</span>
                            </label>
                            <textarea id="task_description" name="description" rows="3"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Detalla la tarea…">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Prioridad --}}
                        <div class="mb-3">
                            <label for="priority" class="form-label fw-semibold small">
                                Prioridad <span class="text-danger">*</span>
                            </label>
                            <select id="priority" name="priority"
                                    class="form-select @error('priority') is-invalid @enderror">
                                <option value="alta"  {{ old('priority') === 'alta'  ? 'selected' : '' }}>Alta</option>
                                <option value="media" {{ old('priority', 'media') === 'media' ? 'selected' : '' }}>Media</option>
                                <option value="baja"  {{ old('priority') === 'baja'  ? 'selected' : '' }}>Baja</option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Estado --}}
                        <div class="mb-4">
                            <label for="status" class="form-label fw-semibold small">
                                Estado <span class="text-danger">*</span>
                            </label>
                            <select id="status" name="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                <option value="backlog"     {{ old('status', 'backlog') === 'backlog'     ? 'selected' : '' }}>Backlog</option>
                                <option value="en_progreso" {{ old('status') === 'en_progreso' ? 'selected' : '' }}>En progreso</option>
                                <option value="testing"     {{ old('status') === 'testing'     ? 'selected' : '' }}>Testing</option>
                                <option value="terminada"   {{ old('status') === 'terminada'   ? 'selected' : '' }}>Terminada</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Añadir tarea
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Columna derecha: lista de tareas --}}
        <div class="col-lg-8">

            @if ($tasks->isEmpty())
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center text-muted py-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                             class="bi bi-card-checklist mb-3 opacity-25" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                        </svg>
                        <p>Aún no hay tareas. Usa el formulario para añadir la primera.</p>
                    </div>
                </div>
            @else
                <div class="d-flex flex-column gap-3">
                    @foreach ($tasks as $task)

                        @php
                            $priorityClass = match($task->priority) {
                                'alta'  => 'danger',
                                'media' => 'warning',
                                'baja'  => 'success',
                            };
                            $statusClass = match($task->status) {
                                'backlog'     => 'secondary',
                                'en_progreso' => 'primary',
                                'testing'     => 'info',
                                'terminada'   => 'success',
                            };
                            $statusLabel = [
                                'backlog'     => 'Backlog',
                                'en_progreso' => 'En progreso',
                                'testing'     => 'Testing',
                                'terminada'   => 'Terminada',
                            ][$task->status];
                            $priorityLabel = [
                                'alta'  => 'Alta',
                                'media' => 'Media',
                                'baja'  => 'Baja',
                            ][$task->priority];
                        @endphp

                        <div class="card border-0 shadow-sm">
                            <div class="card-body d-flex align-items-start justify-content-between gap-3">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                        <h6 class="mb-0 fw-semibold">{{ $task->title }}</h6>
                                        <span class="badge bg-{{ $priorityClass }} bg-opacity-75">
                                            {{ $priorityLabel }}
                                        </span>
                                        <span class="badge bg-{{ $statusClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </div>
                                    @if ($task->description)
                                        <p class="text-muted small mb-0">{{ $task->description }}</p>
                                    @endif
                                </div>
                                <form method="POST"
                                      action="{{ route('tasks.destroy', [$project, $task]) }}"
                                      onsubmit="return confirm('¿Eliminar esta tarea?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
