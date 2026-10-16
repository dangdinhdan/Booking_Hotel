<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_GIANG_VIEN = 'giang_vien';

    public const ROLES = [
        self::ROLE_ADMIN => 'Quản trị viên (Admin)',
        self::ROLE_GIANG_VIEN => 'Giảng viên',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'so_dien_thoai',
        'trang_thai',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'trang_thai' => 'boolean',
        ];
    }

    /**
     * Kiểm tra user có phải Admin hay không.
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Kiểm tra user có phải Giảng viên hay không.
     */
    public function isGiangVien(): bool
    {
        return $this->role === self::ROLE_GIANG_VIEN;
    }

    /**
     * Tên vai trò hiển thị thân thiện.
     */
    public function getRoleNameAttribute(): string
    {
        return self::ROLES[$this->role] ?? $this->role;
    }

    /**
     * Trạng thái dạng chữ.
     */
    public function getTrangThaiTextAttribute(): string
    {
        return $this->trang_thai ? 'Hoạt động' : 'Bị khóa';
    }
}
