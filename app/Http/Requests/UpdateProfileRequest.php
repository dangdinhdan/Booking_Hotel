<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore(auth()->id()),
            ],
            'so_dien_thoai' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    /**
     * Thông báo lỗi tiếng Việt.
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi ký tự.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'min' => ':attribute phải có ít nhất :min ký tự.',
            'unique' => ':attribute đã tồn tại trên hệ thống.',
            'email' => ':attribute không đúng định dạng email.',
            'confirmed' => 'Xác nhận :attribute không khớp.',
            'current_password' => 'Mật khẩu hiện tại không chính xác.',
            'required_with' => 'Vui lòng nhập :attribute khi muốn đổi mật khẩu mới.',
        ];
    }

    /**
     * Tên hiển thị các trường.
     */
    public function attributes(): array
    {
        return [
            'name' => 'Họ và tên',
            'email' => 'Địa chỉ Email',
            'so_dien_thoai' => 'Số điện thoại',
            'current_password' => 'Mật khẩu hiện tại',
            'password' => 'Mật khẩu mới',
            'password_confirmation' => 'Xác nhận mật khẩu mới',
        ];
    }
}
