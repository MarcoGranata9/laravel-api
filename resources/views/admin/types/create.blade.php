@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="d-flex align-items-center mt-4 gap-5">
                @include('partials.prev_btn')
                <h1>Crea nuovo tipo</h1>
            </div>
        
            <form class="mt-4" action="{{ route('admin.types.store') }}" method="POST">
                @csrf
        
                <div class="form-floating mb-3">
                    <input placeholder="name@example.com" type="text" class="form-control @error('name') is-invalid  @enderror"  id="name" name="name" value="{{ old('name') }}">
                    <label for="name">Nome</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Salva</button>  
            </form>
        </div>
    </div>
</div>
@endsection