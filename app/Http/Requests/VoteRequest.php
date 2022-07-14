<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoteRequest extends FormRequest
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
            'option.*.*' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [

            'option.*.*.required'=>'投票可选数量必填',
            'option.*.*.integer'=>'投票可选数量必须是正整数',
            'option.*.*.min'=>'投票可选数量必须是正整数',
        ];
    }
}
