<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersStoreRequest extends FormRequest
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
        $status = [0, 1];
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'avata_url' => 'image|' . (($this->method() == 'POST') ? 'required' : 'nullable'),
            'password' => 'between:,50|alpha_num|' . (($this->method() == 'POST') ? 'required' : 'nullable'),
            'password_confirmation' => 'same:password|required_with:password',
            'phone' => 'required|numeric',
            'address' => 'required',
            'status' => 'in:0, 1'
        ];
    }
}
