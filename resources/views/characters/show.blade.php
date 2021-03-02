@extends('layouts.main')

@section('content')
    <section class="hero" style="background-image: url('{{ $character->image_hero }}')">
    </section>

    <section id="comic-info">
        <div class="container">
            <h1>{{ $character->name }}</h1>
            <div class="my4">
                {!! $character->description !!}
            </div>

            <section class="mt-4">
                <h2 class="color-blue">Related Comics</h2>
                @foreach ($character->comics as $comic)
                    <a href="{{ route('comics.show', $comic->slug) }}" class="pr-3 pb-3 d-inline-block">
                        <img src="{{ asset('storage/' . $comic->image_cover) }}" alt="{{ $comic->title }}">
                    </a>
                @endforeach
            </section>
        </div>    
    </section>
@endsection