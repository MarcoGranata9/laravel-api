@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="d-flex align-items-center mt-4 gap-5">
                @include('partials.prev_btn')
                <h1>Crea una nuova Tecnologia</h1>
            </div>
        
            <form class="mt-4" action="{{ route('admin.technologies.store') }}" method="POST">
                @csrf
        
                <div class="form-floating mb-3">
                    <input placeholder="name@example.com" type="text" class="form-control @error('name') is-invalid  @enderror"  id="name" name="name" value="{{ old('name') }}">
                    <label for="name">Nome</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hex_color" class="form-label">Scegli un colore</label>
                    <input type="color" class="form-control form-control-color" id="hex_color" value="#00000" name="hex_color">
                </div>

                <button type="submit" class="btn btn-success">Salva</button>  
            </form>
        </div>
    </div>
</div>
@endsection