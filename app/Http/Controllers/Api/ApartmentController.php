<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
