<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:12|min:3',
            'price' => 'required|integer|max:10000|min:100'
        ];
    }

    public function attributes(): array
    {
      return [
        'name' => '名前',
        'price' => '価格'
      ];
    }

    public function messages(): array
    {
      return [
        'name.required' => ':attributeを入力してください。',
        'name.min' => ':attributeは:min文字以上で入力してください。',
        'name.max' => ':attributeは:max文字以内で入力してください。',
        'price.required' => ':attributeを入力してください。',
        'price.min' => ':attributeは:min円以上で入力してください。',
        'price.max' => ':attribbuteは:max円以下で入力してください。',
        'price.integer' => ':attributeは数値で入力してください。'
      ];
    }
}
