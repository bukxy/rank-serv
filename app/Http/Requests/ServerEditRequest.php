<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerEditRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'banner.dimensions' => 'Your banner cannot exceed 1200px width / 400px height',
            'logo.dimensions' => 'Your logo cannot exceed 128px width / 128px height',
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'banner' => 'nullable|mimes:png,jpg,jpeg,gif|dimensions:max_width=1200,max_height=400|max:2048',
            'logo' => 'nullable|mimes:png,jpg,jpeg,gif|dimensions:max_width=128,max_height=128|max:2048',
            'name' => 'required',
            'ip'    => 'required',
            'port'  => 'nullable',
            'host_id' => 'required',
            'website'   => 'nullable',
            'slots' => 'nullable',
            'access' => 'required|boolean',
            'description_short' => 'required|max:300|min:50',
            'description' => 'nullable|max:2000',
            'lang'  => 'nullable',
            'tag'   => 'required',
            'discord' => 'nullable',
            'teamspeak' => ['nullable','regex:/[^.0-9]/' ],
            'teamspeak_port' => ['nullable','regex:/[^.0-9]/' ],
            'mumble' => ['nullable','regex:/[^.0-9]/'],
            'mumble_port' => ['nullable','regex:/[^.0-9]/'],
            'twitch' => 'nullable',
            'youtube' => 'nullable',
        ];
    }
}
