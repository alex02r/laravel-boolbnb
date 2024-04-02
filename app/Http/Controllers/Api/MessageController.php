<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data,[
                'user_mail' => 'required|min:5|max:100',
                'message' => 'required|min:5',
                'apartment_id' => 'required'
            ], $errors = [
                'user_mail.required' => 'La email è obbligatoria.',
                'user_mail.max' => 'La email può contenere massimo 100 caratteri.',
                'user_mail.min' => 'La email deve contenere almeno 5 caratteri.',
                'message.required' => 'Il campo per il messaggio è obbligatorio.',
                'message.min' => 'Il campo per il messsagio deve contenere almeno 5 caratteri.',
            ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $message = new Message();
        $message->fill($data);
        $message->save();

        return response()->json([
            'success' => true
        ]);
    }
}
