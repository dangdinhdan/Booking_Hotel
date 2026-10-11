<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLopHocRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ten_lop' => 'required|string|max:255',
            'ma_lop' => 'required|string|max:6|unique:lop_hocs,ma_lop',
            'giao_vien' => 'required|string|max:255',
            'so_dien_thoai_gvcn' => 'nullable|string|max:20',
            'ghi_chu' => 'nullable|string',
            'si_so' => 'required|integer|min:0',
            'trang_thai' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'ten_lop.required' => 'Vui lòng nhập tên lớp.',
            'ma_lop.required' => 'Vui lòng nhập mã lớp.',
            'ma_lop.max' => 'Mã lớp tối đa 6 ký tự.',
            'ma_lop.unique' => 'Mã lớp đã tồn tại.',
            'giao_vien.required' => 'Vui lòng nhập tên giáo viên.',
            'si_so.required' => 'Vui lòng nhập sĩ số.',
            'si_so.integer' => 'Sĩ số phải là số nguyên.',
            'si_so.min' => 'Sĩ số không được nhỏ hơn 0.',
            'trang_thai.required' => 'Vui lòng chọn trạng thái.',
        ];
    }
}
