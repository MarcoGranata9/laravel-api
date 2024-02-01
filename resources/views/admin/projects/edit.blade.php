@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center gap-5 mt-5">
            @include('partials.prev_btn')
            <h1>Modifica: {{ $project->title }}</h1>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <form action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-floating mb-3">
                        <input placeholder="name@example.com" type="text" class="form-control @error('title') is-invalid  @enderror" id="title" name="title" value="{{ old('title', $project->title) }}">
                        <label for="title">Titolo</label>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="description" style="height: 100px" name="description">{{ old('description', $project->description) }}</textarea>
                        <label for="description">Descrizione</label>
                    </div>

                    <div class="mb-3">  
                        <label for="cover_img" class="form-label @error('cover_img') is-invalid  @enderror">Inserisci un'immagine</label>
                        <input class="form-control" type="file" id="cover_img" name="cover_img">
                        @error('cover_img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Anteprima img --}}
                    <div class="mb-3">
                        <p>Immagine corrente:</p>
                        <img class="w-100" id="img_preview" src="{{ asset("storage/$project->cover_img") }}" alt="">
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('type_id') is-invalid  @enderror" id="type" name="type_id">
                            <option @selected(!old('type_id', $project->type_id)) value="">Nessuna</option>
    
                            @foreach ($types as $type)
                                <option @selected(old('type_id', $project->type_id) == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                            
                            @error('type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </select>
                        <label for="type">Seleziona una tipologia</label>
                    </div>                  
                    
                    <div class="mb-3">
                        <p>Seleziona le tecnologie:</p>
                        @foreach ($technologies as $technology)
                            <input @checked($errors->any() ? in_array($technology->id, old('technologies', [])) : $project->technologys->contains($technology)) type="checkbox" class="btn-check" id="tech-{{ $technology->id }}" value="{{ $technology->id }}" name="technologies[]">
                            <label class="btn btn-outline-primary mb-2" for="tech-{{ $technology->id }}">{{$technology->name}}</label>  
                        @endforeach
    
                        @error('technologies')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>    

                    <button type="submit" class="btn btn-success">Salva</button>
                </form>
            </div>            
        </div>

    </div>
@endsection

@section('scripts')
    @vite(['resources/js/preview-img.js'])
@endsection