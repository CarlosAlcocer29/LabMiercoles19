@extends('layouts.app')

@section('content')
<h2 class="display-6 text-center mb-4">Crear Tarea</h2>

<form action="/tasks" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="mb-3">
        <label for="priority" class="form-label">Prioridad</label>
        <select class="form-select" id="priority" name="priority" required>
            <option value="baja">Baja</option>
            <option value="media">Media</option>
            <option value="alta">Alta</option>
        </select>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="completed" name="completed">
        <label class="form-check-label" for="completed">
            Completada
        </label>
    </div>
    <button type="submit" class="btn btn-primary">Crear</button>
</form>
@endsection
