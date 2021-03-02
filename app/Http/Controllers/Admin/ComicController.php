<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Category;
use App\Comic;
use App\Character;

use App\Mail\ComicMail;
use Illuminate\Support\Facades\Mail;

class ComicController extends Controller
{
    private $comicValidation = [
        'category_id' => 'required',
        'image' => 'required|image',
        'image_hero' => 'required|image',
        'image_cover' => 'required|image',
        'title' => 'required|string',
        'price' => 'required|numeric',
        'body' => 'string',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comics = Comic::all();
        return view("admin.comics.index", compact('comics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Crea un nuovo fumetto';
        $categories = Category::all();
        $characters = Character::all();

        return view('admin.comics.create', compact('title', 'categories', 'characters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $request->validate($this->comicValidation);

        $newComic = new Comic();

        $data["slug"] = Str::slug($data["title"]);

        if(!empty($data["image"])) {
            $data["image"] = Storage::disk('public')->put('images', $data["image"]);
        }
        if(!empty($data["image_hero"])) {
            $data["image_hero"] = Storage::disk('public')->put('images', $data["image_hero"]);
        }
        if(!empty($data["image_cover"])) {
            $data["image_cover"] = Storage::disk('public')->put('images', $data["image_cover"]);
        }

        $newComic->fill($data);
        $saved = $newComic->save();

        if($saved) {
            if(!empty($data["characters"])) {
                $newComic->characters()->attach($data["characters"]);
            }

            // Mail::to('pippo@gmail.com')->send(new ComicMail($newComic));

            return redirect()
                ->route('admin.comics.index')
                ->with('message', "Fumetto " . $newComic->title . " creato correttamente!");
        } else {
            return redirect()
                ->route('admin.comics.index')
                ->with('message', "Errore nel salvataggio");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comic $comic)
    {
        // $comic = Comic::findOrFail($id);
        return view('admin.comics.show', compact('comic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comic $comic)
    {
        $categories = Category::all();
        $characters = Character::all();
        return view("admin.comics.edit", compact('comic', 'categories', 'characters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        $data = $request->all();
        // dd($data);

        $updateValidation = $this->comicValidation;
        $updateValidation["image"] = "image";
        $updateValidation["image_cover"] = "image";
        $updateValidation["image_hero"] = "image";

        $request->validate($updateValidation);

        $data["slug"] = Str::slug($data["title"]);

        if(!empty($data["image"])) {
            // verifico se è presente un'immagine precedente, se si devo cancellarla
            if(!empty($comic->image)) {
                Storage::disk('public')->delete($comic->image);
            }

            $data["image"] = Storage::disk('public')->put('images', $data["image"]);
        }

        if(!empty($data["image_hero"])) {
            // verifico se è presente un'immagine precedente, se si devo cancellarla
            if(!empty($comic->image_hero)) {
                Storage::disk('public')->delete($comic->image_hero);
            }

            $data["image_hero"] = Storage::disk('public')->put('images', $data["image_hero"]);
        }

        if(!empty($data["image_cover"])) {
            // verifico se è presente un'immagine precedente, se si devo cancellarla
            if(!empty($comic->image_cover)) {
                Storage::disk('public')->delete($comic->image_cover);
            }

            $data["image_cover"] = Storage::disk('public')->put('images', $data["image_cover"]);
        }

        // gestione relazione N-N comics-characters
        if(empty($data["characters"])) {
            $comic->characters()->detach();
        } else {
            $comic->characters()->sync($data["characters"]);
        }

        $comic->update($data);

        return redirect()
                ->route('admin.comics.show', $comic->id)
                ->with('message', "Fumetto " . $comic->title . " aggiornato correttamente!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comic)
    {
        $comic->delete();

        return redirect()
                ->route('admin.comics.index')
                ->with('message', "Fumetto " . $comic->title . " cancellato correttamente!");
    }
}
