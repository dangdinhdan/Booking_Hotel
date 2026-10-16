<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Quản trị viên mẫu (Admin) - Toàn quyền
        User::updateOrCreate(
            ['email' => 'admin@huce.edu.vn'],
            [
                'name' => 'Quản trị viên (Admin)',
                'password' => Hash::make('12345678'),
                'role' => User::ROLE_ADMIN,
                'so_dien_thoai' => '0988888888',
                'trang_thai' => 1,
            ]
        );

        // 2. Giảng viên mẫu 1
        User::updateOrCreate(
            ['email' => 'giangvien@huce.edu.vn'],
            [
                'name' => 'ThS. Nguyễn Văn A',
                'password' => Hash::make('12345678'),
                'role' => User::ROLE_GIANG_VIEN,
                'so_dien_thoai' => '0912345678',
                'trang_thai' => 1,
            ]
        );

        // 3. Giảng viên mẫu 2
        User::updateOrCreate(
            ['email' => 'tranthib@huce.edu.vn'],
            [
                'name' => 'TS. Trần Thị B',
                'password' => Hash::make('12345678'),
                'role' => User::ROLE_GIANG_VIEN,
                'so_dien_thoai' => '0923456789',
                'trang_thai' => 1,
            ]
        );

        // 4. Giảng viên mẫu 3 (Tài khoản bị khóa để test)
        User::updateOrCreate(
            ['email' => 'levanc@huce.edu.vn'],
            [
                'name' => 'Lê Văn C (Tài khoản bị khóa)',
                'password' => Hash::make('12345678'),
                'role' => User::ROLE_GIANG_VIEN,
                'so_dien_thoai' => '0934567890',
                'trang_thai' => 0,
            ]
        );

        // 5. Sử dụng UserFactory tạo thêm danh sách Giảng viên thực tế để phân trang
        User::factory()->count(10)->giangVien()->create();

        // 6. Tạo thêm 2 Admin phụ
        User::factory()->count(2)->admin()->create();
    }
}
