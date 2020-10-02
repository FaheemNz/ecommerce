<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'postalcode' => 'required|string',
            'phone' => 'required|string|min:6',
            //'name_on_card' => 'required|string|min:4|max:30',
            'stripeToken' => 'required|min:10'
        ];
    }
}
