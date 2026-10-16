<?php

namespace Database\Seeders;

use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Database\Seeder;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lopHocs = LopHoc::all();

        if ($lopHocs->isEmpty()) {
            $this->call(LopHocSeeder::class);
            $lopHocs = LopHoc::all();
        }

        $lopDauTien = $lopHocs->first();

        // 1. Sinh viên mẫu tiêu biểu
        $sinhVienMau = [
            [
                'ma_sinh_vien' => 'SV000001',
                'ho_ten' => 'Nguyễn Văn An',
                'email' => 'nguyenvanan@huce.edu.vn',
                'so_dien_thoai' => '0912345001',
                'ngay_sinh' => '2004-05-15',
                'gioi_tinh' => 1,
                'dia_chi' => 'Hà Nội',
                'lop_hoc_id' => $lopDauTien->id,
                'trang_thai' => 1,
            ],
            [
                'ma_sinh_vien' => 'SV000002',
                'ho_ten' => 'Trần Thị Bình',
                'email' => 'tranthibinh@huce.edu.vn',
                'so_dien_thoai' => '0912345002',
                'ngay_sinh' => '2004-08-20',
                'gioi_tinh' => 0,
                'dia_chi' => 'Nam Định',
                'lop_hoc_id' => $lopDauTien->id,
                'trang_thai' => 1,
            ],
            [
                'ma_sinh_vien' => 'SV000003',
                'ho_ten' => 'Lê Hoàng Cường',
                'email' => 'lehoangcuong@huce.edu.vn',
                'so_dien_thoai' => '0912345003',
                'ngay_sinh' => '2004-02-10',
                'gioi_tinh' => 1,
                'dia_chi' => 'Hải Phòng',
                'lop_hoc_id' => $lopDauTien->id,
                'trang_thai' => 1,
            ],
            [
                'ma_sinh_vien' => 'SV000004',
                'ho_ten' => 'Phạm Minh Dũng (Bảo lưu)',
                'email' => 'phamminhdung@huce.edu.vn',
                'so_dien_thoai' => '0912345004',
                'ngay_sinh' => '2003-11-25',
                'gioi_tinh' => 1,
                'dia_chi' => 'Nghệ An',
                'lop_hoc_id' => $lopDauTien->id,
                'trang_thai' => 0,
            ],
        ];

        foreach ($sinhVienMau as $sv) {
            SinhVien::updateOrCreate(
                ['ma_sinh_vien' => $sv['ma_sinh_vien']],
                $sv
            );
        }

        // 2. Tạo thêm sinh viên ngẫu nhiên phân bổ vào từng lớp học
        foreach ($lopHocs as $lop) {
            $soLuong = rand(3, 8);
            SinhVien::factory()->count($soLuong)->create([
                'lop_hoc_id' => $lop->id,
            ]);
        }

        // 3. Đồng bộ lại sĩ số thực tế cho từng lớp học
        foreach ($lopHocs as $lop) {
            $siSoThucTe = $lop->sinhViens()->count();
            $lop->update(['si_so' => $siSoThucTe]);
        }
    }
}
