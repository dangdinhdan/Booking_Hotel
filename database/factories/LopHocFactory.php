<?php

namespace Database\Factories;

use App\Models\LopHoc;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LopHoc>
 */
class LopHocFactory extends Factory
{
    protected $model = LopHoc::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nganhList = ['CNTT', 'KTPM', 'KHMT', 'XDDD', 'KTXD', 'QTKD', 'KTSU', 'DTTT'];
        $nganh = fake()->randomElement($nganhList);
        $khoa = fake()->numberBetween(66, 69);
        $lopSo = fake()->numberBetween(1, 9);

        $tenNganhMap = [
            'CNTT' => 'Công nghệ Thông tin',
            'KTPM' => 'Kỹ thuật Phần mềm',
            'KHMT' => 'Khoa học Máy tính',
            'XDDD' => 'Xây dựng Dân dụng',
            'KTXD' => 'Kinh tế Xây dựng',
            'QTKD' => 'Quản trị Kinh doanh',
            'KTSU' => 'Kiến trúc Công trình',
            'DTTT' => 'Điện tử Viễn thông',
        ];

        // Mã lớp tối đa 6 ký tự theo validation (ví dụ: 68IT1, 68PM2, 69CS3)
        $shortCodeMap = [
            'CNTT' => 'IT',
            'KTPM' => 'PM',
            'KHMT' => 'CS',
            'XDDD' => 'XD',
            'KTXD' => 'KT',
            'QTKD' => 'BA',
            'KTSU' => 'KT',
            'DTTT' => 'ET',
        ];

        $shortCode = $shortCodeMap[$nganh] ?? 'IT';
        $uniqueSuffix = fake()->unique()->numerify('##');
        $maLop = substr($khoa . $shortCode . $uniqueSuffix, 0, 6);

        $hocVi = fake()->randomElement(['ThS.', 'TS.', 'PGS.TS.', 'GV.']);
        $giaoVien = $hocVi . ' ' . fake('vi_VN')->name();

        return [
            'ten_lop' => ($tenNganhMap[$nganh] ?? 'Công nghệ Thông tin') . ' ' . $khoa . ' - Nhóm ' . $lopSo,
            'ma_lop' => $maLop,
            'giao_vien' => $giaoVien,
            'so_dien_thoai_gvcn' => '09' . fake()->numerify('########'),
            'ghi_chu' => fake()->boolean(60) ? 'Lớp học kỳ chuẩn, phòng ' . fake()->numberBetween(101, 505) . ' nhà H1' : null,
            'si_so' => fake()->numberBetween(35, 60),
            'trang_thai' => fake()->boolean(85), // 85% là hoạt động
        ];
    }

    /**
     * Trạng thái lớp học không hoạt động.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'trang_thai' => false,
        ]);
    }
}
