<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoucherRequest extends FormRequest
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
                'name' => 'required|unique:vouchers',
                'serie' => 'required',
                'from' => 'required',
                'to' => 'required',
                'state' => 'required'
            ];   
        }
        elseif($this->get('action') == 'update')
        {
            $rules = [
                'name' => ['required', Rule::unique('vouchers')->ignore($this->route('voucher')->id)],
                'serie' => 'required',
                'from' => 'required',
                'to' => 'required',
                'state' => 'required'
            ];    
        }
        return $rules;
    }
}
