@extends('layouts.app')

@section('content')
    <h2 class="display-6 text-center mb-4">Editar Tarea</h2>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" required>{{ $task->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="priority" class="form-label">Prioridad</label>
            <select class="form-select" id="priority" name="priority" required>
                <option value="baja" {{ $task->priority == 'baja' ? 'selected' : '' }}>Baja</option>
                <option value="media" {{ $task->priority == 'media' ? 'selected' : '' }}>Media</option>
                <option value="alta" {{ $task->priority == 'alta' ? 'selected' : '' }}>Alta</option>
            </select>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="completed" name="completed" {{ $task->completed ? 'checked' : '' }}>
            <label class="form-check-label" for="completed">
                Completada
            </label>
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Etiquetas</label>
            <select class="form-select" id="tags" name="tags[]" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $task->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
