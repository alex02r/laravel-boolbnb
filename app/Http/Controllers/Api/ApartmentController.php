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

}
