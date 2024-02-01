@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="d-flex justify-content-start align-items-center gap-5 mt-5">
                    @include('partials.prev_btn')
                    <h1>Dettagli di {{ $technology->name }}</h1>
                </div>

                <div class="card mt-4">
                    <p class="badge rounded-pill fs-2" style="background-color: {{ $technology->hex_color }}">Nome: {{$technology->name}}</p>
                    <p>Slug: {{$technology->slug}}</p>  
                </div>
            </div>
        </div>
    </div>
@endsection