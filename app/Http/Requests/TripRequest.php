<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'title' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'description' => 'nullable',
            'start' => 'required|date_format:Y-m-d H:i:s|after:tomorrow',
            'end' => 'required|date_format:Y-m-d H:i:s|after:start',
            'type_id' => 'required'
        ];
    }
}
