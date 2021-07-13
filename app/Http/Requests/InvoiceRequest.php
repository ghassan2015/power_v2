<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'Customer_id'=>'required',
            'current_reading'=>'required',
            'previous_reading'=>'required',
            'Total'=>'required',
            'month'=>'required',
            'year'=>'required',
        ];
    }
}
