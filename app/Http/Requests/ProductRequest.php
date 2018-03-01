<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
                'category_id' => 'required',
                'brand_id' => 'required',
                'presentation_id' => 'required',
                'name' => 'required|unique:products',
                'minimum_stock' => 'required',
                'stock' => 'required',
                'purchase_price' => 'required',
                'sale_price' => 'required',
                'state' => 'required'
            ];   
        }
        elseif($this->get('action') == 'update')
        {
            $rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'presentation_id' => 'required',
                'name' => ['required', Rule::unique('products')->ignore($this->route('product')->id)],
                'minimum_stock' => 'required',
                'stock' => 'required',
                'purchase_price' => 'required',
                'sale_price' => 'required',
                'state' => 'required'
            ];    
        }

        return $rules;
    }
}
