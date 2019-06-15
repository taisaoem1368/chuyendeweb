<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginRequest extends Request {

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
			'email'=>'required|email',
            'password'=>'required|min:6|max:60',
		];
	}
	public function messages() {
		return [
			'email.required'=> 'Vui lòng nhập email',
            'email.email'=> 'Không đúng định dạng email',
            'password.required'=> 'Vui lòng nhập mật khẩu',
            'password.min'=> 'Mật khẩu ít nhất 6 kí tự'
		];
	}

}
