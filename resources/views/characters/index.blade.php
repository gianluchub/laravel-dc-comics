@extends('layouts.main')

@section('content')
    
    <section class="hero" style="background-image: url('{{ asset('images/bg-hero-home.jpg') }}')">

    </section>

    <section id="comics-list">
        <div class="container">
            <h1>All characters</h1>
            <div class="row">
                @foreach ($characters as $character)    
                    <div class="col-12 col-sm-6 col-lg-2 mt-4">
                        <a href="{{ route('characters.show', $character->slug) }}" class="comic">
                            <span>{{ $character->name }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection