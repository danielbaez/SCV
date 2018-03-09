<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
        if($this->get('action') == 'store')
        {
            $rules = [
                'voucher' => 'required',
                'customer_id' => 'required',
                'voucher_serie' => 'required',
                'voucher_number' => 'required',
                'date' => 'required'
            ];   
        }
        elseif($this->get('action') == 'update')
        {
             
        }

        return $rules;
    }
}
