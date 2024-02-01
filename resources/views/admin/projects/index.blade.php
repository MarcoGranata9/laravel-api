@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center mt-4 gap-5">
            @include('partials.prev_btn')
            <h1>Tabella dei progetti</h1>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary ">Crea nuovo progetto</a>
                <a href="{{ route('admin.projects.trash') }}" class="btn btn-danger">Progetti eliminati</a>
            </div>
        </div>

        @if (Session::has('message'))
            <div class="alert alert-success mt-3">
                {{ Session::get('message') }}
            </div>
        @endif


        <table class="table table-hover mt-4">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
                        <td>
                            <div class="d-flex gap-3">
                                <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}" class="btn btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                                        
                                @include('admin.projects.partials.edit_btn')
    
                                @include('admin.projects.partials.delete_btn')
                            </div>
                        </td>
                    </tr>                    
                @endforeach
            </tbody>
          </table>
    </div>
    @include('partials.delete_modal')
@endsection