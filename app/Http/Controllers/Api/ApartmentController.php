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
    
    public function search($address){
        //fare una query, dove facciamo la select di lat e lon del primo risultato where address = $address

        //chimata API a tom tom nearby con lat e lon trovate prima
            //foreach di freeformAddress del risultato
            //assegno a una variabile apartments[]= where address == freeformAddress
        
        
        
        $httpsAgent = new \GuzzleHttp\Client(['verify' => false]);
        $api_key = env('VITE_TOMTOM_API_KEY');
        $url = env('VITE_TOMTOM_BASE_URL') . '/search/2/';
        
        //effettuiamo la chiamata
        $search_address = $httpsAgent->get($url.'geocode/'.$address.'.json?key='.$api_key.'&language=it-IT');
        $address_results = json_decode($search_address->getBody(), true);
        $address_results = $address_results['results'];

        if (!empty($address_results)) {
            //recuper latitudine e longitudine
            $lat = $address_results[0]['position']['lat'];
            $lon = $address_results[0]['position']['lon'];
            //effettuiamo la chiamata
            $response = $httpsAgent->get($url.'nearbySearch/.json?key='.$api_key.'&lat='.$lat.'&lon='.$lon.'&radius=20000&limit=100');

            //convertiamo l'array dei risultati in array associativo 
            $results = json_decode($response->getBody(), true);
            $results = $results['results'];

            foreach ($results as $result ) {
                $nearby_apartment = Apartment::where('address', $result['address']['freeformAddress'])->get();
                if (count($nearby_apartment) > 0) {
                    $apartments[]=$nearby_apartment->first();
                }
            }

            if(empty($apartments)){
                return response()->json([
                    'success' => false,
                    'error' => 'Errore durante la ricerca dell\'indirizzo',
                ]);
            }
            //invio dei dati come risposa alla chiamata API
            return response()->json([
                'success' => true,
                'apartments' => $apartments
            ]);

        }else{
            return response()->json([
                'success' => false,
                'error' => 'Non ci sono bnb in questa zona',
            ]);
        }
        
    }
}
