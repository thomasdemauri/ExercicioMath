@extends('components.layout')

@section('container')
    <!-- operations -->
    <div class="container">

        <hr>

        <div class="row">

            <!-- each operation -->
            <div class="col-3 display-6 mb-3">
                <span class="badge bg-dark">1</span>
                <span>000</span>
                <span>+</span>
                <span>000</span>
            </div>

            <div class="col-3 display-6 mb-3">
                <span class="badge bg-dark">2</span>
                <span>000</span>
                <span>+</span>
                <span>000</span>
            </div>

            <div class="col-3 display-6 mb-3">
                <span class="badge bg-dark">3</span>
                <span>000</span>
                <span>+</span>
                <span>000</span>
            </div>

            <div class="col-3 display-6 mb-3">
                <span class="badge bg-dark">4</span>
                <span>000</span>
                <span>+</span>
                <span>000</span>
            </div>

            <div class="col-3 display-6 mb-3">
                <span class="badge bg-dark">4</span>
                <span>000</span>
                <span>+</span>
                <span>000</span>
            </div>

        </div>

        <hr>

    </div>

    <!-- print version -->
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <a href="#" class="btn btn-primary px-5">VOLTAR</a>
            </div>
            <div class="col text-end">
                <a href="#" class="btn btn-secondary px-5">DESCARREGAR EXERCÍCIOS</a>
                <a href="#" class="btn btn-secondary px-5">IMPRIMIR EXERCÍCIOS</a>
            </div>
        </div>
    </div>

@endsection