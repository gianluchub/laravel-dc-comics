<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comic;

class ComicController extends Controller
{
    
    public function index() {
        $comics = Comic::all();

        return view('comics.index', compact('comics'));
    }

    public function show($slug) {
        $comic = Comic::where('slug', $slug)->firstOrFail();

        return view('comics.show', compact('comic'));
    }

}
