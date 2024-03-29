<?php

namespace App\Http\Controllers\User;


use App\Models\Apartment;
use App\Models\Service;
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
        $services = Service::all();
        return view('user.apartment.create-apartment',compact('services'));
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
        $results = $results['results'];
        //controlliamo che l'array contenga un risultato e che corrisponda all'indirizzo inserito nella form
        if(!empty($results) && $results[0]['address']['freeformAddress'] == $query){
            $new_apartment->fill($form_data);
            //inseriamo le cordinate trovate
            $new_apartment->lat = $results[0]['position']['lat'];
            $new_apartment->lon = $results[0]['position']['lon'];
        }else{
            $error_message='L\'indirizzo che hai inserito non è stato trovato.';
            return redirect()->route('user.apartment.create')->with('error_address',$error_message);
        }
        //definiamo lo slug
        $new_apartment->slug = Str::slug($form_data['title'], '-');
        //assegnamo l'id dell'utente loggato allo user_id
        $new_apartment->user_id = Auth::user()->id;

        //controlliamo la checkbox
        if ($request->has('show')) {
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

        if($request->has('services')){
            $new_apartment->services()->attach($form_data['services']);
        }


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
        if ($apartment->user_id != Auth::id()) {
            return view('errors.not_authorized');
        }

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
        if ($apartment->user_id != Auth::id()) {
            return view('errors.not_authorized');
        }

        $services = Service::all();
        return view('user.apartment.edit-apartments', compact('apartment','services'));
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
        $results = $results['results'];
        //controlliamo che l'array contenga un risultato e che corrisponda all'indirizzo inserito nella form
        if (!empty($results) && $results[0]['address']['freeformAddress'] == $query) {
            $apartment->fill($form_data);
            //inseriamo le cordinate trovate
            $apartment->lat = $results[0]['position']['lat'];
            $apartment->lon = $results[0]['position']['lon'];
        } else {
            $error_message='L\'indirizzo che hai inserito non è stato trovato.';
            return redirect()->route('user.apartment.edit', ['apartment'=>$apartment])->with('error_address', $error_message);
        } 

        //definiamo lo slug
        $apartment->slug = Str::slug($form_data['title'], '-');
        //assegnamo l'id dell'utente loggato allo user_id
        $apartment->user_id = Auth::user()->id;


        // VERIFICO SE LA RICHIESTA CONTIENE IL CAMPO cover_img
        if ($request->hasFile('cover_img')) {
            // Se l'appartamento ha un'immagine
            if ($apartment->cover_img != null) {
                Storage::disk('public')->delete($apartment->cover_img);
            }
            // Eseguo l'upload del file e recupero il path
            $path = Storage::disk('public')->put('uploads', $form_data['cover_img']);
            $form_data['cover_img'] = $path;
        }

        // SALVO I DATI
        $apartment->update($form_data);
        
        //controlliamo la checkbox
        if ($request->has('show')) {
            //il checkbox è selezionato e settiamo true il parametro show
            $apartment->show = true;
        } else {
            $apartment->show = false;
        }
        $apartment->save();
        if($request->has('services')){
            $apartment->services()->sync($form_data['services']);
        }
        // FACCIO IL REDIRECT ALLA PAGINA SHOW 
        return redirect()->route('user.apartment.show', compact('apartment'));
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

        return redirect()->route('user.apartment.index');
    }
}
