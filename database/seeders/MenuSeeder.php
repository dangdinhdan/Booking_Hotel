<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // Header
            [
                'vi_tri' => 'header',
                'nhom' => null,
                'ten' => 'Trang chủ',
                'url' => '/lophoc',
                'thu_tu' => 1,
                'trang_thai' => 1,
            ],
            [
                'vi_tri' => 'header',
                'nhom' => null,
                'ten' => 'Lớp học',
                'url' => '/lophoc',
                'thu_tu' => 2,
                'trang_thai' => 1,
            ],
            [
                'vi_tri' => 'header',
                'nhom' => null,
                'ten' => 'Sinh viên',
                'url' => '/sinhvien',
                'thu_tu' => 3,
                'trang_thai' => 1,
            ],
            [
                'vi_tri' => 'header',
                'nhom' => null,
                'ten' => 'Người dùng',
                'url' => '/user',
                'thu_tu' => 4,
                'trang_thai' => 1,
            ],
            [
                'vi_tri' => 'header',
                'nhom' => null,
                'ten' => 'Quản lý Menu',
                'url' => '/menu',
                'thu_tu' => 5,
                'trang_thai' => 1,
            ],

            // Sidebar - Quản lý đào tạo
            [
                'vi_tri' => 'sidebar',
                'nhom' => 'Quản lý đào tạo',
                'ten' => 'Danh sách lớp học',
                'url' => '/lophoc',
                'thu_tu' => 1,
                'trang_thai' => 1,
            ],
            [
                'vi_tri' => 'sidebar',
                'nhom' => 'Quản lý đào tạo',
                'ten' => 'Thêm lớp học',
                'url' => '/lophoc/create',
                'thu_tu' => 2,
                'trang_thai' => 1,
            ],
            [
                'vi_tri' => 'sidebar',
                'nhom' => 'Quản lý đào tạo',
                'ten' => 'Danh sách sinh viên',
                'url' => '/sinhvien',
                'thu_tu' => 3,
                'trang_thai' => 1,
            ],
            [
                'vi_tri' => 'sidebar',
                'nhom' => 'Quản lý đào tạo',
                'ten' => 'Thêm sinh viên',
                'url' => '/sinhvien/create',
                'thu_tu' => 4,
                'trang_thai' => 1,
            ],

            // Sidebar - Hệ thống (Dành cho Admin)
            [
                'vi_tri' => 'sidebar',
                'nhom' => 'Hệ thống',
                'ten' => 'Quản lý người dùng',
                'url' => '/user',
                'thu_tu' => 5,
                'trang_thai' => 1,
            ],
            [
                'vi_tri' => 'sidebar',
                'nhom' => 'Hệ thống',
                'ten' => 'Thêm người dùng',
                'url' => '/user/create',
                'thu_tu' => 6,
                'trang_thai' => 1,
            ],
            [
                'vi_tri' => 'sidebar',
                'nhom' => 'Hệ thống',
                'ten' => 'Quản lý Menu',
                'url' => '/menu',
                'thu_tu' => 7,
                'trang_thai' => 1,
            ],

            // Sidebar - Cá nhân (Tất cả người dùng)
            [
                'vi_tri' => 'sidebar',
                'nhom' => 'Cá nhân',
                'ten' => 'Tài khoản của tôi',
                'url' => '/profile',
                'thu_tu' => 8,
                'trang_thai' => 1,
            ],
        ];

        foreach ($menus as $m) {
            Menu::updateOrCreate(
                ['vi_tri' => $m['vi_tri'], 'ten' => $m['ten'], 'url' => $m['url']],
                $m
            );
        }
    }
}
