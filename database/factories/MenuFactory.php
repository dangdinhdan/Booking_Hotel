<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $viTri = fake()->randomElement(['header', 'sidebar']);
        $nhoms = ['Quản lý đào tạo', 'Hệ thống', 'Cá nhân', 'Báo cáo - Thống kê'];

        return [
            'ten' => fake()->randomElement(['Quản lý Điểm', 'Thời khóa biểu', 'Đăng ký môn học', 'Lịch thi', 'Học phí', 'Thông báo']),
            'url' => '/' . fake()->unique()->slug(2),
            'vi_tri' => $viTri,
            'nhom' => $viTri === 'sidebar' ? fake()->randomElement($nhoms) : null,
            'thu_tu' => fake()->numberBetween(1, 15),
            'trang_thai' => true,
        ];
    }

    /**
     * Menu vị trí Header.
     */
    public function header(): static
    {
        return $this->state(fn (array $attributes) => [
            'vi_tri' => 'header',
            'nhom' => null,
        ]);
    }

    /**
     * Menu vị trí Sidebar.
     */
    public function sidebar(?string $nhom = 'Quản lý đào tạo'): static
    {
        return $this->state(fn (array $attributes) => [
            'vi_tri' => 'sidebar',
            'nhom' => $nhom,
        ]);
    }
}
