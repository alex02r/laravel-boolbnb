<?php

namespace App\Http\Requests;

use App\Models\Apartment;
use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:'.Apartment::class, 
            'address' => 'required',
            'rooms' => 'required|min:0|max:255|numeric|integer', 
            'bathrooms' => 'required|min:0|max:255|numeric|integer', 
            'beds' => 'required|min:0|max:255|numeric|integer', 
            'square_meters' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'cover_img' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'show',
        ];
    }
    public function messages(){
        return [
            /* messaggi per il titolo*/
            'title.required' => 'Il titolo è obbligatorio',
            'title.unique' => 'Il titolo che hai inseito è già esistente',

            /* messaggi per l'address */
            'address.required' => 'L\'indirizzo deve essere obbligatorio',

            /* messaggi per rooms */
            'rooms.required' => 'É obbligatorio inserire il numero di stanze',
            'rooms.min' => 'Non puoi inserire meno di 0 stanze',
            'rooms.max' => 'Il numero massimo di stanze è 255',
            'rooms.numeric' => 'Il campo stanze deve essere un numero',
            'rooms.integer' => 'Il campo stanze deve essere un numero intero',

            /* messaggi per bathrooms */
            'bathrooms.required' => 'É obbligatorio inserire il numero di bagni',
            'bathrooms.min' => 'Non puoi inserire meno di 0 bagni',
            'bathrooms.max' => 'Il numero massimo di bagni è 255',
            'bathrooms.numeric' => 'Il campo bagni deve essere un numero',
            'bathrooms.integer' => 'Il campo bagni deve essere un numero intero',

            /* messaggi per beds */
            'beds.required' => 'É obbligatorio inserire il numero di letti',
            'beds.min' => 'Non puoi inserire meno di 0 letti',
            'beds.max' => 'Il numero massimo di letti è 255',
            'beds.numeric' => 'Il campo letti deve essere un numero',
            'beds.integer' => 'Il campo letti deve essere un numero intero',

        ];
    }
}
