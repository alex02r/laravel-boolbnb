<?php

namespace App\Http\Controllers\User;


use App\Models\Apartment;
use App\Models\User;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $apartments = Apartment::where('user_id', auth()->user()->id)->get();

        return view('user.apartment.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.apartment.create-apartment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        $form_data = $request->all();
        dump($form_data);
        
        //creo nuova classe aparment
        $new_apartment = new Apartment();

        //Variabile che ci permette di eseguire la chiamata API anche lato server
        $httpsAgent = new \GuzzleHttp\Client(['verify' => false]);
        //definiamo l'API KEY per la chiamata API
        $api_key = env('VITE_TOMTOM_API_KEY');
        //definiamo l'url per la chimata API
        $url = env('VITE_TOMTOM_BASE_URL').'/search/2/search/';
        //aseggno l'indirizzo a una variabile query
        $query = $form_data['address'];

        //effettuiamo la chiamata
        $response = $httpsAgent->get($url . $query . '.json?key='.$api_key.'&language=it-IT');

        //convertiamo l'array dei risultati in array associativo 
        $results = json_decode($response->getBody(), true);
        $results = $results['results'][0];
        dump($results);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('user.apartment.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        //
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
        //
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
