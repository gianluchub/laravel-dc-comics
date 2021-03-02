<header>
    <div class="header-top">

    </div>
    <nav class="header-bottom">
        <div class="container d-flex justify-content-between">
            <a href="{{ route('comics.index') }}">
                <img src="{{ asset('images/logo.png') }}" alt="DC Comics">
            </a>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a class="{{ Route::currentRouteName() == 'characters.index' ? 'active' : '' }}" href="{{ route('characters.index') }}">CHARACTERS</a>
                </li>    
                <li class="list-inline-item">
                    <a class="{{ Route::currentRouteName() == 'comics.index' ? 'active' : '' }}" href="{{ route('comics.index') }}">COMICS</a>
                </li>
            </ul>
        </div>
    </nav>
</header>