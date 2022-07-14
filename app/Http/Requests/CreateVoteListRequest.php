<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVoteListRequest extends FormRequest
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
            'votelist_title' => 'required|unique:App\Models\VoteList,title|max:128',
            'votelist_description' => 'required',
            'is_anonymous' => 'required|boolean',
            'partment' => 'required|exists:user_partments,id',
            'start_time' => 'required|date_format:Y/m/d H:i',
            'end_time' => 'required|date_format:Y/m/d H:i|after:start_time',
            'vote_title.*' => 'required',
            'vote_description.*' => 'required',
            'selectable_number.*'=>'required|integer|min:1',
            'vote_option.*.*' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'votelist_title.required'=>'投票活动名必填',
            'votelist_title.unique'=>'投票活动名不可重复',
            'votelist_title.max'=>'投票活动名不可超过128字符',
            'votelist_description.required'=>'投票活动描述必填',
            'is_anonymous.required'=>'是否匿名必填',
            'partment.required'=>'投票部门范围必填',
            'start_time.required'=>'开始时间必填',
            'end_time.required'=>'结束时间必填',
            'end_time.after'=>'开始时间必须早于结束时间',
            'start_time.date_format'=>'开始时间必须符合格式 Y/m/d H:i',
            'end_time.date_format'=>'结束时间必须符合格式 Y/m/d H:i',
            'vote_title.*.required'=>'每个投票名必填',
            'vote_description.*.required'=>'每个投票描述必填',
            'selectable_number.*.required'=>'投票可选数量必填',
            'selectable_number.*.integer'=>'投票可选数量必须是正整数',
            'selectable_number.*.min'=>'投票可选数量必须是正整数',
            'vote_option.*.*.required'=>'每个投票选项不可为空（多余请按删除选项）',
        ];
    }
}
