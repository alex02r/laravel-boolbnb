<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\View;

class ViewController extends Controller
{
    public function incrementVisit(Request $request)
    {

        $apartmentId = $request->input('apartment_id');
        $ipUser = $request->ip();

        // Verifica se la visita esiste già
        // $view = View::where('apartment_id', $apartmentId)
        //         ->where('ip', $ipUser)
        //         ->first();

        // if (!$view) {
        //     // Se la visita non esiste, crea un nuovo record
        //     View::create([
        //         'apartment_id' => $apartmentId,
        //         'ip' => $ipUser,
        //     ]);
        // }

        View::create([
            'apartment_id' => $apartmentId,
            'ip' => $ipUser,
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
