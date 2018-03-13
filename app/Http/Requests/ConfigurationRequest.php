<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationRequest extends FormRequest
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
        if($this->get('action') == 'update')
        {
            $rules = [
                'company' => 'required',
                'document' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'tax' => 'required',
                'tax_percentage' => 'required',
                'currency' => 'required'
            ];    
            
            if(!empty($this->file('logo')))
            {
                $rules['logo'] = ['required', 'image', 'max:2048'];
            }
        }
        return $rules;
    }
}
