<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            $dbMenus = collect();

            if (Schema::hasTable('menus')) {
                $dbMenus = Menu::where('trang_thai', true)
                    ->orderBy('thu_tu')
                    ->orderBy('id')
                    ->get();
            }

            if ($dbMenus->isEmpty()) {
                $dbMenus = collect([
                    new Menu([
                        'vi_tri' => 'header',
                        'ten' => 'Trang chủ',
                        'url' => route('lophoc.index'),
                        'thu_tu' => 1,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'header',
                        'ten' => 'Lớp học',
                        'url' => route('lophoc.index'),
                        'thu_tu' => 2,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'header',
                        'ten' => 'Sinh viên',
                        'url' => route('sinhvien.index'),
                        'thu_tu' => 3,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'header',
                        'ten' => 'Người dùng',
                        'url' => route('user.index'),
                        'thu_tu' => 4,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'header',
                        'ten' => 'Quản lý Menu',
                        'url' => route('menu.index'),
                        'thu_tu' => 5,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'sidebar',
                        'nhom' => 'Quản lý đào tạo',
                        'ten' => 'Danh sách lớp học',
                        'url' => route('lophoc.index'),
                        'thu_tu' => 1,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'sidebar',
                        'nhom' => 'Quản lý đào tạo',
                        'ten' => 'Thêm lớp học',
                        'url' => route('lophoc.create'),
                        'thu_tu' => 2,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'sidebar',
                        'nhom' => 'Quản lý đào tạo',
                        'ten' => 'Danh sách sinh viên',
                        'url' => route('sinhvien.index'),
                        'thu_tu' => 3,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'sidebar',
                        'nhom' => 'Quản lý đào tạo',
                        'ten' => 'Thêm sinh viên',
                        'url' => route('sinhvien.create'),
                        'thu_tu' => 4,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'sidebar',
                        'nhom' => 'Hệ thống',
                        'ten' => 'Quản lý người dùng',
                        'url' => route('user.index'),
                        'thu_tu' => 5,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'sidebar',
                        'nhom' => 'Hệ thống',
                        'ten' => 'Quản lý Menu',
                        'url' => route('menu.index'),
                        'thu_tu' => 6,
                        'trang_thai' => true,
                    ]),
                    new Menu([
                        'vi_tri' => 'sidebar',
                        'nhom' => 'Cá nhân',
                        'ten' => 'Tài khoản của tôi',
                        'url' => route('profile.edit'),
                        'thu_tu' => 7,
                        'trang_thai' => true,
                    ]),
                ]);
            }

            // Phân quyền hiển thị menu: Giảng viên chỉ thấy Lớp học, Sinh viên, Tài khoản cá nhân
            if (Auth::check() && !Auth::user()->isAdmin()) {
                $dbMenus = $dbMenus->filter(function ($menu) {
                    $url = strtolower($menu->url ?? '');
                    // Ẩn các menu quản lý user và menu đối với Giảng viên
                    if (str_contains($url, '/user') || str_contains($url, '/menu') || $menu->nhom === 'Hệ thống') {
                        return false;
                    }
                    return true;
                });
            }

            $menuHienThi = $dbMenus->groupBy('vi_tri');

            $view->with('menuHienThi', $menuHienThi);
        });
    }
}
