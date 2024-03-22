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
            'user_id' => 'required', 
            'title' => 'required|unique:'.Apartment::class, 
            'rooms' => 'required|min:0|max:255|numeric|integer', 
            'bathrooms' => 'required|min:0|max:255|numeric|integer', 
            'beds' => 'required|min:0|max:255|numeric|integer', 
            'square_meters' => 'required',,
            'address' => 'required',,
            'lat' => 'required',,
            'lon' => 'required',,
            'cover_img' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'show',
        ];
    }
}
