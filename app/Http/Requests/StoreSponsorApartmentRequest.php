<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSponsorApartmentRequest extends FormRequest
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
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i'
        ];
    }
    public function messages()
    {
        return [
            'start_date.required' => 'la data deve essere obbligatorio',
            'start_date.date' => 'Devi inserire una data',

            'start_time.required' => 'l\'orario deve essere obbligatorio',
            'start_date.date_format' => 'Non hai inserito un formato di ora adatto'
        ];
    }
}
