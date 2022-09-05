<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'user_id' => 'required',
            'title' => 'string|nullable',
            'origin' => 'string|nullable',
            'destination' => 'string|nullable',
            'description' => 'string|nullable',
            'start' => 'date_format:Y-m-d H:i:s|after:tomorrow|required_with:end|nullable',
            'end' => 'date_format:Y-m-d H:i:s|after:start|required_with:start|nullable',
            'type_id' => 'required'
        ];
    }
}
