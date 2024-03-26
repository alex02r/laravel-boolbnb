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
    
    public function search($value){
        $apartments[] = Apartment::where('address', $value);
        
        //invio dei dati come risposa alla chiamata API
        return response()->json([
            'success' => true,
            'apartments' => $apartments
        ]);
    }
}
