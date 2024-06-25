<!-- resources/views/tasks/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">Crear una Tarea</h1>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/tasks" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Ingresa el nombre de la tarea">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" name="description" id="description" rows="4" placeholder="Ingresa la descripción de la tarea"></textarea>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block">Crear Tarea</button>
    </form>
@endsection
