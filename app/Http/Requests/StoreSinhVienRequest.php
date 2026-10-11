<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSinhVienRequest extends FormRequest
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
            'ma_sinh_vien' => 'required|string|max:20|unique:sinh_viens,ma_sinh_vien',
            'ho_ten' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'so_dien_thoai' => 'nullable|string|max:20',
            'ngay_sinh' => 'nullable|date',
            'gioi_tinh' => 'required|in:0,1',
            'dia_chi' => 'nullable|string|max:255',
            'lop_hoc_id' => 'required|exists:lop_hocs,id',
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
            'unique' => ':attribute đã tồn tại trên hệ thống.',
            'email' => ':attribute không đúng định dạng email.',
            'date' => ':attribute không đúng định dạng ngày tháng.',
            'in' => ':attribute không hợp lệ.',
            'exists' => ':attribute không tồn tại.',
        ];
    }

    /**
     * Tên hiển thị các trường.
     */
    public function attributes(): array
    {
        return [
            'ma_sinh_vien' => 'Mã sinh viên',
            'ho_ten' => 'Họ và tên',
            'email' => 'Địa chỉ Email',
            'so_dien_thoai' => 'Số điện thoại',
            'ngay_sinh' => 'Ngày sinh',
            'gioi_tinh' => 'Giới tính',
            'dia_chi' => 'Địa chỉ',
            'lop_hoc_id' => 'Lớp học',
            'trang_thai' => 'Trạng thái',
        ];
    }
}
