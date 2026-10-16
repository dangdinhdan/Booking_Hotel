<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $giangVien;
    protected User $lockedUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::firstOrCreate(
            ['email' => 'admin_test@huce.edu.vn'],
            [
                'name' => 'Admin Test',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_ADMIN,
                'so_dien_thoai' => '0988888888',
                'trang_thai' => 1,
            ]
        );

        $this->giangVien = User::firstOrCreate(
            ['email' => 'giangvien_test@huce.edu.vn'],
            [
                'name' => 'Giang Vien Test',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_GIANG_VIEN,
                'so_dien_thoai' => '0911111111',
                'trang_thai' => 1,
            ]
        );

        $this->lockedUser = User::firstOrCreate(
            ['email' => 'locked_test@huce.edu.vn'],
            [
                'name' => 'Locked User Test',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_GIANG_VIEN,
                'so_dien_thoai' => '0922222222',
                'trang_thai' => 0,
            ]
        );
    }

    /**
     * Test: Khách chưa đăng nhập phải bị chuyển hướng đến /login.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/lophoc');
        $response->assertRedirect('/login');

        $responseUser = $this->get('/user');
        $responseUser->assertRedirect('/login');
    }

    /**
     * Test: Đăng nhập thành công với tài khoản hợp lệ.
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin_test@huce.edu.vn',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/lophoc');
        $this->assertAuthenticatedAs($this->admin);
    }

    /**
     * Test: Tài khoản bị khóa không thể đăng nhập.
     */
    public function test_locked_user_cannot_login(): void
    {
        $response = $this->post('/login', [
            'email' => 'locked_test@huce.edu.vn',
            'password' => 'password123',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test: Giảng viên có thể truy cập Lớp học, Sinh viên và Tài khoản của bản thân.
     */
    public function test_giang_vien_can_access_allowed_features(): void
    {
        $this->actingAs($this->giangVien);

        $responseLopHoc = $this->get('/lophoc');
        $responseLopHoc->assertStatus(200);

        $responseSinhVien = $this->get('/sinhvien');
        $responseSinhVien->assertStatus(200);

        $responseProfile = $this->get('/profile');
        $responseProfile->assertStatus(200);
    }

    /**
     * Test: Giảng viên KHÔNG THỂ truy cập Quản lý người dùng (403).
     */
    public function test_giang_vien_cannot_access_user_management(): void
    {
        $this->actingAs($this->giangVien);

        $responseUser = $this->get('/user');
        $responseUser->assertStatus(403);

        $responseUserCreate = $this->get('/user/create');
        $responseUserCreate->assertStatus(403);
    }

    /**
     * Test: Giảng viên KHÔNG THỂ truy cập Quản lý Menu (403).
     */
    public function test_giang_vien_cannot_access_menu_management(): void
    {
        $this->actingAs($this->giangVien);

        $responseMenu = $this->get('/menu');
        $responseMenu->assertStatus(403);
    }

    /**
     * Test: Giảng viên có thể cập nhật tài khoản của bản thân.
     */
    public function test_giang_vien_can_update_own_profile(): void
    {
        $this->actingAs($this->giangVien);

        $response = $this->put('/profile', [
            'name' => 'Giang Vien Updated Name',
            'email' => 'giangvien_test@huce.edu.vn',
            'so_dien_thoai' => '0999888777',
        ]);

        $response->assertRedirect('/profile');
        $this->assertDatabaseHas('users', [
            'id' => $this->giangVien->id,
            'name' => 'Giang Vien Updated Name',
            'so_dien_thoai' => '0999888777',
        ]);
    }

    /**
     * Test: Admin có thể truy cập toàn bộ chức năng.
     */
    public function test_admin_can_access_all_features(): void
    {
        $this->actingAs($this->admin);

        $this->get('/lophoc')->assertStatus(200);
        $this->get('/sinhvien')->assertStatus(200);
        $this->get('/profile')->assertStatus(200);
        $this->get('/user')->assertStatus(200);
        $this->get('/user/create')->assertStatus(200);
        $this->get('/menu')->assertStatus(200);
    }

    /**
     * Test: Admin có thể tạo tài khoản người dùng mới.
     */
    public function test_admin_can_create_new_user(): void
    {
        $this->actingAs($this->admin);

        $response = $this->post('/user', [
            'name' => 'New Teacher Created',
            'email' => 'new_teacher@huce.edu.vn',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => User::ROLE_GIANG_VIEN,
            'so_dien_thoai' => '0901234567',
            'trang_thai' => 1,
        ]);

        $response->assertRedirect('/user');
        $this->assertDatabaseHas('users', [
            'email' => 'new_teacher@huce.edu.vn',
            'name' => 'New Teacher Created',
            'role' => User::ROLE_GIANG_VIEN,
        ]);
    }

    /**
     * Test: Đăng nhập thành công bằng Số điện thoại.
     */
    public function test_user_can_login_with_phone_number(): void
    {
        $response = $this->post('/login', [
            'email' => '0988888888',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/lophoc');
        $this->assertAuthenticatedAs($this->admin);
    }

    /**
     * Test: Báo lỗi khi mật khẩu không chính xác.
     */
    public function test_user_cannot_login_with_wrong_password(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin_test@huce.edu.vn',
            'password' => 'sai-mat-khau',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test: Đăng xuất tài khoản an toàn.
     */
    public function test_authenticated_user_can_logout(): void
    {
        $this->actingAs($this->admin);

        $response = $this->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    /**
     * Test: Admin không thể tự xóa tài khoản của chính mình.
     */
    public function test_admin_cannot_delete_themselves(): void
    {
        $this->actingAs($this->admin);

        $response = $this->delete('/user/' . $this->admin->id);
        $response->assertSessionHas('error');

        $this->assertDatabaseHas('users', [
            'id' => $this->admin->id,
        ]);
    }
}
