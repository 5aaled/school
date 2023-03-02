<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storeclassroom extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "List_Classes.*.name"=>"required
            |unique:classrooms
            "
        ];
    }
    public function messages()
    {
       return [

            "List_Classes.*.name.required" =>"the name is required "
        ];
    }
}
