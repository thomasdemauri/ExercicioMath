@extends('components.layout')

@section('container')
    <!-- operations -->
    <div class="container">

        <hr>

        <div class="row">

            @forelse ($exercises as $exercise)
                <!-- each operation -->
                <div class="col-3 display-6 mb-3">
                    <span class="badge bg-dark">{{ $exercise['exercise_number'] }}</span>
                    <span>{{ $exercise['equation'] }}</span>
                </div>
            @empty
                <p class="text-center mt-3">Nenhum exercico criado.</p>
            @endforelse
        </div>

        <hr>

    </div>

    <!-- print version -->
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <a href="{{ route('home') }}" class="btn btn-primary px-5">VOLTAR</a>
            </div>
            <div class="col text-end">
                <a href="{{ route('print') }}" class="btn btn-secondary px-5">IMPRIMIR EXERCÍCIOS</a>
            </div>
        </div>
    </div>

@endsection