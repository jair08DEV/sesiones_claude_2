@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Nuevo proyecto</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-semibold">Crear nuevo proyecto</h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        {{-- Nombre --}}
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">
                                Nombre del proyecto
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="Ej. Rediseño de sitio web"
                                autofocus
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                Descripción
                                <span class="text-muted fw-normal small">(opcional)</span>
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Describe brevemente los objetivos del proyecto…"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Fecha límite --}}
                        <div class="mb-4">
                            <label for="deadline" class="form-label fw-semibold">
                                Fecha límite
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                type="date"
                                id="deadline"
                                name="deadline"
                                value="{{ old('deadline') }}"
                                class="form-control @error('deadline') is-invalid @enderror"
                            >
                            @error('deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        {{-- Acciones --}}
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                Guardar proyecto
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
