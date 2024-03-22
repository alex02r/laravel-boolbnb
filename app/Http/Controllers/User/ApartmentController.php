<?php

namespace App\Http\Controllers\User;


use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('user.apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentRequest  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $form_apartments = $request->all();

        // VERIFICO SE LA RICHIESTA CONTIENE IL CAMPO cover_image
        if ($request->hasFile('cover_image')) {
            // Se il post ha un'immagine
            if ($apartment->cover_image != null) {
                Storage::disk('public')->delete($apartment->cover_image);
            }
            // Eseguo l'upload del file e recupero il path
            $path = Storage::disk('public')->put('apartment_image', $form_apartments['cover_image']);
            $form_apartments['cover_image'] = $path;
        }

        // LO SLUG LO RECUPERO IN UN SECONDO MOMENTO, IN QUANTO NON LO PASSO NEL FORM
        // $form_apartments['slug'] = Str::slug($form_apartments['title'], '-');

        // SALVO I DATI
        $apartment->update($form_apartments);

        // FACCIO IL REDIRECT ALLA PAGINA SHOW 
        return redirect()->route('user.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
