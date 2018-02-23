<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'state' => 'required',
                'rol_id' => 'required',
                'document' => 'required|max:8|unique:users',
                'birth_date' => 'required',
                'address' => 'required',
                'phone' => 'required|max:9|unique:users',
            ];   
        }
        elseif($this->get('action') == 'update')
        {
            $rules = [
                'name' => 'required',
                'lastname' => 'required',
                'email' => ['required', Rule::unique('users')->ignore($this->route('user')->id)],
                'state' => 'required',
                'rol_id' => 'required',
                'document' => ['required', 'max:8', Rule::unique('users')->ignore($this->route('user')->id)],
                'birth_date' => 'required',
                'address' => 'required',
                'phone' => ['required', 'max:9', Rule::unique('users')->ignore($this->route('user')->id)]
            ];    
        }

        if(!empty($this->get('password')))
        {
            $rules['password'] = ['required', 'min:6'];   
        }
        
        if($this->hasFile('photo'))
        {
            $rules['photo'] = ['required', 'image', 'max:2048'];
        }

        return $rules;

    }
}
