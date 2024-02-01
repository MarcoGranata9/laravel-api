@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="d-flex justify-content-start align-items-center gap-5 mt-5">
                    @include('partials.prev_btn')
                    <h1>Dettagli di {{ $type->name }}</h1>
                </div>

                <div class="card mt-4">
                    <p>Nome: {{$type->name}}</p>
                    <p>Slug: {{$type->slug}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection