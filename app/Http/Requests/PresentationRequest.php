<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PresentationRequest extends FormRequest
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
                'name' => 'required|unique:presentations',
                'state' => 'required'
            ];   
        }
        elseif($this->get('action') == 'update')
        {
            $rules = [
                'name' => ['required', Rule::unique('presentations')->ignore($this->route('presentation')->id)],
                'state' => 'required'
            ];    
        }
        return $rules;
    }
}
