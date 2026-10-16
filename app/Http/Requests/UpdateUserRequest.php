<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user') instanceof User ? $this->route('user')->id : $this->route('user');

        return [
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:' . implode(',', array_keys(User::ROLES)),
            'so_dien_thoai' => 'nullable|string|max:20',
            'trang_thai' => 'required|in:0,1',
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
            'in' => ':attribute không hợp lệ.',
            'confirmed' => 'Xác nhận :attribute không khớp.',
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
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Xác nhận mật khẩu mới',
            'role' => 'Vai trò',
            'so_dien_thoai' => 'Số điện thoại',
            'trang_thai' => 'Trạng thái',
        ];
    }
}
