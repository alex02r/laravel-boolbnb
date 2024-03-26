<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Apartment;

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
        $apartments = Apartment::where('address', 'LIKE', $address)->paginate(6);
        //fare una query, dove facciamo la select di lat e lon del primo risultato where address = $address

        //chimata API a tom tom nearby con lat e lon trovate prima
            //foreach di freeformAddress del risultato
            //assegno a una variabile apartments[]= where address == freeformAddress
        

        if (!empty($apartments)) {
            //invio dei dati come risposa alla chiamata API
            return response()->json([
                'success' => true,
                'apartments' => $apartments
            ]);
        }else{
            return response()->json([
                'success' => false,
                'error' => 'non sono stati trovati apartments con questo indirizzo'
            ]);
        }
        
    }
}
