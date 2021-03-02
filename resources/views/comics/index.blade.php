@extends('layouts.main')

@section('content')
    
    <section class="hero" style="background-image: url('{{ asset('images/bg-hero-home.jpg') }}')">

    </section>

    <section id="comics-list">
        <div class="container">
            <h1>Current Series</h1>
            <div class="row">
                @foreach ($comics as $comic)    
                    <div class="col-12 col-sm-6 col-lg-2 mt-4">
                        <a href="{{ route('comics.show', $comic->slug) }}" class="comic">
                            <img class="img-fluid" src="{{ asset("storage/" . $comic->image) }}" alt="{{ $comic->title }}">
                            <span>{{ $comic->title }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection