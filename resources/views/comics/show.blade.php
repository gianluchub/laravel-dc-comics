@extends('layouts.main')

@section('content')
    <section class="hero comic-hero" style="background-image: url('{{ asset('storage/' . $comic->image_hero) }}')">
        <div class="container">
            <img src="{{ asset('storage/' . $comic->image_cover) }}" alt="{{ $comic->title }}">
        </div>
    </section>

    <section id="comic-info">
        <div class="container">
            <p class="h2">
                <span class="badge badge-dark">{{ $comic->category->name }}</span>
            </p>
            <h1>{{ $comic->title }}</h1>
            <p class="h1">
                <span class="badge badge-success">{{ $comic->price }}</span>
            </p>
            <div class="my-4">{!! $comic->body !!}</div>
            <small>{{ $comic->created_at->format('d-m-Y') }}</small>

            <h2 class="color-blue mt-4">Characters</h2>
            <ul>
                @foreach ($comic->characters as $character)                
                    <li>
                        <a href="{{ route('characters.show', $character->slug) }}">{{ $character->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>    
    </section>
@endsection