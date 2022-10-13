<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['bail','required','string','unique:products,name','max:255'],
            'price' => ['required','integer','min:0'],
            'quantity' => ['required','integer','min:0'],
            'excerpt' => ['nullable']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống.',
            'unique' => ':attribute đã tồn tại.',
            'integer' => ':attribute phải là số.',
            'min' => ':attribute nhỏ nhất là :min.'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá bán',
            'quantity' => 'Số lượng',
            'excerpt' => 'Mô tả'
        ];
    }

}
