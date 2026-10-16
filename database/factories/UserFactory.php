<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake('vi_VN')->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('12345678'),
            'role' => User::ROLE_GIANG_VIEN,
            'so_dien_thoai' => '09' . fake()->numerify('########'),
            'trang_thai' => true,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Trạng thái tài khoản Quản trị viên (Admin).
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => User::ROLE_ADMIN,
        ]);
    }

    /**
     * Trạng thái tài khoản Giảng viên.
     */
    public function giangVien(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => User::ROLE_GIANG_VIEN,
        ]);
    }

    /**
     * Trạng thái tài khoản bị khóa.
     */
    public function locked(): static
    {
        return $this->state(fn (array $attributes) => [
            'trang_thai' => false,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
