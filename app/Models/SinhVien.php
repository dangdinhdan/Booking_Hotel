<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinh_viens';

    protected $fillable = [
        'ma_sinh_vien',
        'ho_ten',
        'email',
        'so_dien_thoai',
        'ngay_sinh',
        'gioi_tinh',
        'dia_chi',
        'lop_hoc_id',
        'trang_thai',
    ];

    protected $casts = [
        'gioi_tinh' => 'boolean',
        'trang_thai' => 'boolean',
        'ngay_sinh' => 'date',
    ];

    /**
     * Mối quan hệ: Một sinh viên thuộc về một lớp học.
     */
    public function lopHoc()
    {
        return $this->belongsTo(LopHoc::class, 'lop_hoc_id');
    }
}
