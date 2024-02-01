@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                
                <div class="d-flex justify-content-between align-items-center mt-5">
                    @include('partials.prev_btn')
                    <h1>Progetto nel dettaglio</h1>
                    <div class="d-flex gap-3">
                        @include('admin.projects.partials.edit_btn')
                        @include('admin.projects.partials.delete_btn')
                    </div>
                </div>

                @if ($project->type)
                    <p class="mt-4 badge text-bg-info rounded-pill">Tipologia: {{ $project->type->name }}</p>
                @else
                    <p class="mt-4 badge text-bg-warning rounded-pill">Tipologia: Nessuna</p>
                @endif
                
                @if (count($project->technologys) > 0)
                    <p class="badge rounded-pill text-bg-warning"> Tecnologie usate:
                        @foreach ($project->technologys as $technology)
                            <span class="badge rounded-pill" style="background-color: {{ $technology->hex_color }}"> {{ $technology->name }}</span>
                        @endforeach
                    </p>
                @else
                    <p class="mt-4 badge text-bg-warning rounded-pill">Tecnologie usate: Nessuna</p>
                @endif

                <div class="card mt-4">
                    <h3>{{ $project->title }}</h3>
                    <img src="{{ asset('storage/' . $project->cover_img) }}" alt="">
                    <p>{{ $project->description }}</p>
                </div>
            </div>
        </div>    
    </div>
    @include('partials.delete_modal')
@endsection