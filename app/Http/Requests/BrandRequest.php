<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
                'name' => 'required|unique:brands',
                'state' => 'required'
            ];   
        }
        elseif($this->get('action') == 'update')
        {
            $rules = [
                'name' => ['required', Rule::unique('brands')->ignore($this->route('brand')->id)],
                'state' => 'required'
            ];    
        }
        return $rules;
    }
}
