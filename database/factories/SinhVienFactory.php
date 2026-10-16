<?php

namespace Database\Factories;

use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SinhVien>
 */
class SinhVienFactory extends Factory
{
    protected $model = SinhVien::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gioiTinh = fake()->boolean(60); // 60% nam, 40% nữ
        $cities = ['Hà Nội', 'Hải Phòng', 'Nam Định', 'Thái Bình', 'Nghệ An', 'Thanh Hóa', 'Bắc Ninh', 'Quảng Ninh', 'Hà Nam', 'Vĩnh Phúc'];

        return [
            'ma_sinh_vien' => 'SV' . fake()->unique()->numerify('######'),
            'ho_ten' => fake('vi_VN')->name($gioiTinh ? 'male' : 'female'),
            'email' => fake()->unique()->safeEmail(),
            'so_dien_thoai' => '09' . fake()->numerify('########'),
            'ngay_sinh' => fake()->dateTimeBetween('-24 years', '-18 years')->format('Y-m-d'),
            'gioi_tinh' => $gioiTinh ? 1 : 0,
            'dia_chi' => fake()->randomElement($cities),
            'lop_hoc_id' => LopHoc::factory(),
            'trang_thai' => fake()->boolean(90) ? 1 : 0, // 90% đang học
        ];
    }

    /**
     * Sinh viên nam.
     */
    public function nam(): static
    {
        return $this->state(fn (array $attributes) => [
            'gioi_tinh' => 1,
            'ho_ten' => fake('vi_VN')->name('male'),
        ]);
    }

    /**
     * Sinh viên nữ.
     */
    public function nu(): static
    {
        return $this->state(fn (array $attributes) => [
            'gioi_tinh' => 0,
            'ho_ten' => fake('vi_VN')->name('female'),
        ]);
    }

    /**
     * Trạng thái đang học.
     */
    public function dangHoc(): static
    {
        return $this->state(fn (array $attributes) => [
            'trang_thai' => 1,
        ]);
    }

    /**
     * Trạng thái thôi học / tạm dừng.
     */
    public function thoiHoc(): static
    {
        return $this->state(fn (array $attributes) => [
            'trang_thai' => 0,
        ]);
    }
}
