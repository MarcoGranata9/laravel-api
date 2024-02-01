@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex align-items-center mt-4 gap-5">
        @include('partials.prev_btn')
        <h1>Progetti eliminati</h1>

    </div>

    @if (Session::has('message'))
        <div class="alert alert-success">
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
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>
                        <form action="{{ route('admin.trash.restore', ['project' => $project->slug]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-primary"><i class="fa-solid fa-recycle"></i></button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.trash.delete', ['project' => $project->slug]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger delete-btn"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>                    
            @endforeach
        </tbody>
      </table>
</div>
@include('partials.delete_modal')
@endsection