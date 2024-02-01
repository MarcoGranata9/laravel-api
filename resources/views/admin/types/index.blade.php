@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center mt-4 gap-5">
            @include('partials.prev_btn')
            <h1>Tabella dei tipi</h1>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.types.create') }}" class="btn btn-primary ">Crea nuovo tipo</a>
            </div>
        </div>

        @if (Session::has('message'))
            <div class="alert alert-success mt-3">
                {{ Session::get('message') }}
            </div>
        @endif
        
        <table class="table table-info table-striped table-hover mt-4">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Slug</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <th>{{$type->id}}</th>
                        <td>{{$type->name}}</td>
                        <td>{{$type->slug}}</td>
                        <td>
                            <a href="{{route('admin.types.show', ['type'=> $type->slug])}}" class="btn btn-primary"><i class="fa-solid fa-circle-info"></i></a>  
                            <a href="{{route('admin.types.edit', ['type'=> $type->slug])}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="d-inline-block" action="{{route('admin.types.destroy', ['type'=> $type->slug])}}" method="POST">
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