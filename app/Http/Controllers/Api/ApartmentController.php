<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Apartment;

use function PHPUnit\Framework\isEmpty;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();
        
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }
    
    public function search(Request $request){
        
        $query = [];

        //controlliamo sei nei parametri della richiesta API sia inserito l'address
        if ($request->has('address')) {
            //recuperiamo il valore dell'indizirro richiesto
            $address = $request->input('address');
            if (!empty($address)) {
                $coordinates = $this->getCoordinates($address);
                $query= Apartment::whereRaw('(6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(lon) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) < ?', [
                    $coordinates['lat'],
                    $coordinates['lon'],
                    $coordinates['lat'],
                    $request->input('distance', 100),
                ]);
            }
        }

        //filtraggio per stanze
        if ($request->has('rooms')) {
            $rooms = $request->input('rooms');
            if (!empty($rooms)) {
                //seleziono gli apartments dove il numero di stanze è uguale o maggiore
                $query->where('rooms','>=', $rooms );
            }
        }

        //filtraggio per i letti
        if ($request->has('beds')) {
            $beds = $request->input('beds');
            if (!empty($beds)) {
                //seleziono gli apartments dove il numero di letti è uguale o maggiore
                $query->where('beds','>=', $beds );
            }
        }

        //filtraggio per bagni
        if ($request->has('bathrooms')) {
            $bathrooms = $request->input('bathrooms');
            if (!empty($bathrooms)) {
                //seleziono gli apartments dove il numero di bagni è uguale o maggiore
                $query->where('bathrooms','>=', $bathrooms );
            }
        }

        //filtraggio per i servizi
        if ($request->has('services')) {
            $services = $request->input('services');
            if (!empty($services)) {
                $query->whereHas('services', function ($q) use ($services) {
                    $q->whereIn('id', $services);
                });
            }
        }

        $apartments = $query->with('sponsors')->get();
        if(empty($query)){
            return response()->json([
                'success' => false,
                'error' => 'Array vuoto'
            ]);
        }

        return response()->json([
            'success' => true,
            'apartments' => $apartments
        ]);
    }

    public function singleApartment($slug, $id){
        $apartment = Apartment::with('services')->where('id', $id)->where('slug', $slug)->get();
    
        if($apartment->isEmpty()){
            return response()->json([
                'success' => false,
                'error' => 'Array vuoto'
            ]);
        }
    
        return response()->json([
            'success' => true,
            'apartment' => $apartment
        ]);
    }

    //funzione che ci restituisce latitudine e longitudine di un indirizzo
    private function getCoordinates($address)
    {
        $client = new \GuzzleHttp\Client(['verify' => false]);

        // Verifico se l'indirizzo è vuoto o non valido
        if (empty($address) || !is_string($address)) {
            throw new \Exception('Indirizzo non valido');
        }

        $api_key = env('VITE_TOMTOM_API_KEY');
        $url = env('VITE_TOMTOM_BASE_URL').'/search/2/geocode/';

        $response = $client->get($url . urlencode($address) . '.json?key='.$api_key.'&language=it-IT');

        // Verifico se la richiesta ha avuto successo
        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Errore durante l\'accesso all\'API di TomTom');
        }

        // recupero i risultati della chiamata API
        $results = json_decode($response->getBody(), true);
        //controllo che abbia trovato un indirizzo
        if (!isset($results['results']) || empty($results['results'])) {
            throw new \Exception('Indirizzo non trovato');
        }

        //recupero latitudine e longitudine
        $lon = $results['results'][0]['position']['lon'];
        $lat = $results['results'][0]['position']['lat'];

        return compact('lat', 'lon');
    }

    public function sponsor()
    {
       
        $sponsorApartments = Apartment::with('sponsors')->whereHas('sponsors')->get();
        
        return response()->json([
            'success' => true,
            'results' => $sponsorApartments
        ]);
    }
}
