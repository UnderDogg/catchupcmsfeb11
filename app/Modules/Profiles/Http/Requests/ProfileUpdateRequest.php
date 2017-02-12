<?php

namespace App\Modules\Profiles\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProfileUpdateRequest extends FormRequest {


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
		return [
			'first_name'				=> 'required',
			'last_name'					=> 'required',
			'email_1'					=> 'required|email',
//			'password'					=> 'required|confirmed|' . Config::get('kagi.password_min', 'min:6') . '',
//			'password'					=> 'required|confirmed|min:6',
//			'password_confirmation'		=> 'required_with:password'
//			'roles'						=> 'required',
		];
	}


}
