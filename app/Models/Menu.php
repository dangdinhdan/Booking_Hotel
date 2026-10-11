<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public const VI_TRI = [
        'header' => 'Header',
        'sidebar' => 'Sidebar',
    ];

    protected $fillable = [
        'ten',
        'url',
        'vi_tri',
        'nhom',
        'thu_tu',
        'trang_thai',
    ];

    protected $casts = [
        'trang_thai' => 'boolean',
        'thu_tu' => 'integer',
    ];

    public function dangChon(): bool
    {
        $currentUrl = request()->url();
        $targetUrl = url($this->url ?? '');

        return $currentUrl === $targetUrl || request()->fullUrlIs($this->url . '*');
    }
}
