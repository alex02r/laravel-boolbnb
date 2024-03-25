<?php

namespace App\Http\Controllers\User;


use App\Models\Apartment;
use App\Models\User;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        //controlliamo che l'array contenga un risultato e che corrisponda all'indirizzo inserito nella form
        if(!empty($results) && $results['address']['freeformAddress'] == $query){
            $new_apartment->fill($form_data);
            //inseriamo le cordinate trovate
            $new_apartment->lat = $results['position']['lat'];
            $new_apartment->lon = $results['position']['lon'];
        }else{
            $error_message = 'L\'indirizzo che hai trovato non è stato trovato.';
            return redirect()->route('user.apartment.create');
        }
        //definiamo lo slug
        $new_apartment->slug = Str::slug($form_data['title'], '-');
        //assegnamo l'id dell'utente loggato allo user_id
        $new_apartment->user_id = Auth::user()->id;

        //controlliamo la checkbox
        if ($form_data['show'] == 1) {
            //il checkbox è selezionato e settiamo true il parametro show
            $new_apartment->show = true;
        }else{
            $new_apartment->show = false;
        }

        //controlliamo se l'utente abbia inserito un immagine
        if ($request->hasFile('cover_img')) {
            //creaiamo il path e lo assegnamo all'apartment
            $new_apartment->cover_img = Storage::disk('public')->put('uploads', $form_data['cover_img']);
        }

        //Salviamo l'appartamento nel db
        $new_apartment->save();


        return redirect()->route('user.apartment.index');
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
        return view('user.apartment.edit-apartments', compact('apartment'));
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
        $form_data = $request->all();

        //creo nuova classe aparment
        $new_apartment = new Apartment();

        //Variabile che ci permette di eseguire la chiamata API anche lato server
        $httpsAgent = new \GuzzleHttp\Client(['verify' => false]);
        //definiamo l'API KEY per la chiamata API
        $api_key = env('VITE_TOMTOM_API_KEY');
        //definiamo l'url per la chimata API
        $url = env('VITE_TOMTOM_BASE_URL') . '/search/2/search/';
        //aseggno l'indirizzo a una variabile query
        $query = $form_data['address'];

        //effettuiamo la chiamata
        $response = $httpsAgent->get($url . $query . '.json?key=' . $api_key . '&language=it-IT');

        //convertiamo l'array dei risultati in array associativo 
        $results = json_decode($response->getBody(), true);
        $results = $results['results'][0];

        //controlliamo che l'array contenga un risultato e che corrisponda all'indirizzo inserito nella form
        if (!empty($results) && $results['address']['freeformAddress'] == $query) {
            $new_apartment->fill($form_data);
            //inseriamo le cordinate trovate
            $new_apartment->lat = $results['position']['lat'];
            $new_apartment->lon = $results['position']['lon'];
        } else {
            $error_message = 'L\'indirizzo che hai inserito non è stato trovato.';
            return redirect()->route('user.apartment.edit');
        }
        //definiamo lo slug
        $new_apartment->slug = Str::slug($form_data['title'], '-');
        //assegnamo l'id dell'utente loggato allo user_id
        $new_apartment->user_id = Auth::user()->id;

        //controlliamo la checkbox
        if ($form_data['show'] == 1) {
            //il checkbox è selezionato e settiamo true il parametro show
            $new_apartment->show = true;
        } else {
            $new_apartment->show = false;
        }

        // VERIFICO SE LA RICHIESTA CONTIENE IL CAMPO cover_img
        if ($request->hasFile('cover_img')) {
            // Se il post ha un'immagine
            if ($apartment->cover_img != null) {
                Storage::disk('public')->delete($apartment->cover_img);
            }
            // Eseguo l'upload del file e recupero il path
            $path = Storage::disk('public')->put('uploads', $form_data['cover_img']);
            $form_data['cover_img'] = $path;
        }

        // SALVO I DATI
        $new_apartment->update($form_data);;

        // FACCIO IL REDIRECT ALLA PAGINA SHOW 
        return redirect()->route('user.apartment.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if($apartment->cover_img != null){
            Storage::disk('public')->delete($apartment->cover_img);
        }
        $apartment->delete();

        return redirect()->route('user.apartments.index');
    }
}
