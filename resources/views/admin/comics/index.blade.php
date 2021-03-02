@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session("message"))
            <div class="alert alert-success">
                {{ session("message") }}
            </div>
        @endif

        <div class="clearfix mb-4">
            <h1 class="float-left">Tutti i fumetti</h1>
            <a href="{{ route('admin.comics.create') }}" class="btn btn-primary float-right mb-4">Crea un nuovo fumetto</a>
        </div>    
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titolo</th>
                    <th>Categoria</th>
                    <th>Prezzo</th>
                    <th>Copertina</th>
                    <th colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comics as $comic)
                    <tr>
                        <td>{{ $comic->id }}</td>
                        <td>{{ $comic->title }}</td>
                        <td>{{ $comic->category->name }}</td>
                        <td>{{ $comic->price }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $comic->image_cover) }}" alt="{{ $comic->title }}">
                        </td>
                        <td>
                            <a href="{{ route('admin.comics.show', $comic->id) }}" class="btn btn-info">Mostra</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.comics.edit', $comic->id) }}" class="btn btn-success">Modifica</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.comics.destroy', $comic->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Elimina" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
@endsection