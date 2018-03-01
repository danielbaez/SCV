<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProviderRequest extends FormRequest
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
                'business_name' => 'required|unique:providers',
                'name' => 'required',
                'lastname' => 'required',
                'document' => 'required|unique:providers',
                'address' => 'required',
                'phone' => 'required',
                'state' => 'required'
            ];   
        }
        elseif($this->get('action') == 'update')
        {
            $rules = [
                'business_name' => ['required', Rule::unique('providers')->ignore($this->route('provider')->id)],
                'name' => 'required',
                'lastname' => 'required',
                'document' => ['required', Rule::unique('providers')->ignore($this->route('provider')->id)],
                'address' => 'required',
                'phone' => 'required',
                'state' => 'required'
            ];    
        }

        return $rules;
    }
}
