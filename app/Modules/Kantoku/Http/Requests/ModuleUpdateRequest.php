<?php

namespace App\Modules\Kantoku\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ModuleUpdateRequest extends FormRequest {

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
//			'slug'						=> 'required|alpha_num',
		];
	}

}
