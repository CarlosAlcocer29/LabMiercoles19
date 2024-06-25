@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Tarea ID: {{ $task->id }}</h1>
        <hr>
        <h2>{{ $task->name }}</h2>
        <p>{{ $task->description }}</p>

        <a href="/tasks/{{ $task->id }}/edit" class="btn btn-primary">Editar</a>

        <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
@endsection
