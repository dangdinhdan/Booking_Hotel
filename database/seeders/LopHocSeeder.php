<?php

namespace Database\Seeders;

use App\Models\LopHoc;
use Illuminate\Database\Seeder;

class LopHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $danhSachLopChuan = [
            [
                'ma_lop' => '68IT1',
                'ten_lop' => 'Công nghệ Thông tin 68 - Nhóm 1',
                'giao_vien' => 'PGS.TS. Trần Đình Dân',
                'so_dien_thoai_gvcn' => '0912345678',
                'ghi_chu' => 'Lớp chất lượng cao, phòng máy 302-H1',
                'si_so' => 45,
                'trang_thai' => 1,
            ],
            [
                'ma_lop' => '68IT2',
                'ten_lop' => 'Công nghệ Thông tin 68 - Nhóm 2',
                'giao_vien' => 'ThS. Nguyễn Văn A',
                'so_dien_thoai_gvcn' => '0923456789',
                'ghi_chu' => 'Lớp tiêu chuẩn, phòng học 204-H2',
                'si_so' => 50,
                'trang_thai' => 1,
            ],
            [
                'ma_lop' => '68PM1',
                'ten_lop' => 'Kỹ thuật Phần mềm 68 - Nhóm 1',
                'giao_vien' => 'TS. Lê Quang Huy',
                'so_dien_thoai_gvcn' => '0934567890',
                'ghi_chu' => 'Chuyên ngành Kỹ thuật phần mềm',
                'si_so' => 48,
                'trang_thai' => 1,
            ],
            [
                'ma_lop' => '68CS1',
                'ten_lop' => 'Khoa học Máy tính 68 - Nhóm 1',
                'giao_vien' => 'TS. Trần Thị B',
                'so_dien_thoai_gvcn' => '0945678901',
                'ghi_chu' => 'Định hướng Trí tuệ nhân tạo & Dữ liệu lớn',
                'si_so' => 42,
                'trang_thai' => 1,
            ],
            [
                'ma_lop' => '68XD1',
                'ten_lop' => 'Xây dựng Dân dụng 68 - Nhóm 1',
                'giao_vien' => 'ThS. Phạm Văn Hùng',
                'so_dien_thoai_gvcn' => '0956789012',
                'ghi_chu' => 'Khoa Xây dựng Dân dụng & Công nghiệp',
                'si_so' => 55,
                'trang_thai' => 1,
            ],
            [
                'ma_lop' => '68KT1',
                'ten_lop' => 'Kinh tế Xây dựng 68 - Nhóm 1',
                'giao_vien' => 'ThS. Vũ Thị Mai',
                'so_dien_thoai_gvcn' => '0967890123',
                'ghi_chu' => 'Khoa Kinh tế & Quản lý Xây dựng',
                'si_so' => 40,
                'trang_thai' => 1,
            ],
            [
                'ma_lop' => '67IT1',
                'ten_lop' => 'Công nghệ Thông tin 67 - Nhóm 1 (Đã tốt nghiệp)',
                'giao_vien' => 'TS. Hoàng Đức Long',
                'so_dien_thoai_gvcn' => '0978901234',
                'ghi_chu' => 'Khóa cũ đã hoàn thành đồ án',
                'si_so' => 38,
                'trang_thai' => 0,
            ],
        ];

        foreach ($danhSachLopChuan as $lop) {
            LopHoc::updateOrCreate(
                ['ma_lop' => $lop['ma_lop']],
                $lop
            );
        }

        // Tạo thêm 8 lớp học ngẫu nhiên bằng LopHocFactory
        LopHoc::factory()->count(8)->create();
    }
}
