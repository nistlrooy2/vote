<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnonymousRequest extends FormRequest
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
            'level' => 'required|exists:user_position_levels,id',
            'number' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'level.required'=>'职位必填',
            'number.required'=>'数量必填',
            'number.integer'=>'数量必须是正整数',
            'number.min'=>'数量必须是正整数',
        ];
    }
}
