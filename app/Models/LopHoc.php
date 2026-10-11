<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    use HasFactory;

    protected $table = 'lop_hocs';

    protected $fillable = [
        'ten_lop',
        'ma_lop',
        'giao_vien',
        'so_dien_thoai_gvcn',
        'ghi_chu',
        'si_so',
        'trang_thai',
    ];

    protected $casts = [
        'trang_thai' => 'boolean',
        'si_so' => 'integer',
    ];

    /**
     * Mối quan hệ: Một lớp học có nhiều sinh viên.
     */
    public function sinhViens()
    {
        return $this->hasMany(SinhVien::class, 'lop_hoc_id');
    }
}
