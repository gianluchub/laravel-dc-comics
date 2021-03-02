@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="clearfix mb-4">
            <h1 class="float-left">Modifica del fumetto "{{ $comic->title }}"</h1>
            <a href="{{ route('admin.comics.index') }}" class="btn btn-primary float-right">Elenco fumetti</a>
        </div>    
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.comics.update', $comic->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="title">Titolo</label>
                <input class="form-control" type="text" id="title" name="title" value="{{ $comic->title }}">
            </div>

            <div class="form-group">
                <label for="price">Prezzo</label>
                <input class="form-control" type="text" id="price" name="price" value="{{ $comic->price }}">
            </div>

            <div class="form-group">
                <label for="body">Testo</label>
                <textarea id="body" name="body" class="form-control" rows="10">{{ $comic->body }}</textarea>
            </div>

            <hr>

            <div class="form-group">
                <label for="image">Immagine elenco</label>
                @if(!empty($comic->image))
                    <img class="d-block" src="{{ asset('storage/' . $comic->image) }}" alt="{{ $comic->title }}">
                @endif
                <p class="mt-2">Modifica l'immagine precedentemente caricata</p>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <hr>

            <div class="form-group">
                <label for="image_hero">Immagine hero</label>
                <img class="img-fluid d-block" src="{{ asset('storage/' . $comic->image_hero) }}" alt="{{ $comic->title }}">
                <p class="mt-2">Modifica l'immagine precedentemente caricata</p>
                <input type="file" class="form-control" id="image_hero" name="image_hero" accept="image/*">
            </div>

            <hr>

            <div class="form-group">
                <label for="image_cover">Immagine cover</label>
                <img class="d-block" src="{{ asset('storage/' . $comic->image_cover) }}" alt="{{ $comic->title }}">
                <p class="mt-2">Modifica l'immagine precedentemente caricata</p>
                <input type="file" class="form-control" id="image_cover" name="image_cover" accept="image/*">
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Scegli la categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @if ($category->id == $comic->category_id) selected @endif
                            >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="characters">Personaggi</label>
                <select class="form-control" name="characters[]" id="characters" multiple >
                    @foreach ($characters as $character)          
                        <option value="{{ $character->id }}"
                            @if ($comic->characters->contains($character->id)) selected @endif
                            >{{ $character->name }}</option>
                    @endforeach
                </select>
            </div>   

            <input type="submit" value="Salva" class="btn btn-primary">
        </form>
    </div>
@endsection