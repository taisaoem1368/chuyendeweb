<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request {

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
            'email'=>'required|email|unique:users,email|regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/u',
            'password'=>'required|min:6|max:60',
            'name'=>'required|max:60|min:6',
            'phone' => 'required|unique:users,phone|min:10|max:15',//numerric
		];
	}

	public function messages() {
		return [
			'email.regex' => 'Không đúng định dạng email',
			'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email đã có người sử dụng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu tối đa 60 kí tự',
            'name.required'=>'Vui lòng nhập tên',
            'name.max' => 'Tên tối đa có 60 ký tự',
            'name.min' => 'Tên tối thiểu có 6 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
           // 'phone.numeric' => 'Số điện thoại phải là số',
            'phone.min' => 'Số điện thoại ít nhất 10 số',
            'phone.unique' => 'Số điện thoại đã có người sử dụng',
            'phone.max' => 'Số điện thoại nhiều nhất 15 số'
		];
	}
}
