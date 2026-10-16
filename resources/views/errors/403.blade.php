@extends('layouts.layoutmaster')
@section('title', 'Từ chối truy cập (403)')

@section('content')
    <div class="text-center py-5">
        <div style="font-size: 72px; font-weight: 800; color: #e03131; line-height: 1;">403</div>
        <h2 class="mt-3 mb-2" style="font-size: 24px; color: var(--c-header);">Bạn không có quyền truy cập</h2>
        <p class="text-muted mx-auto" style="max-width: 500px;">
            {{ $exception->getMessage() ?: 'Chức năng này chỉ dành cho Quản trị viên (Admin). Giảng viên chỉ có quyền quản lý lớp học, quản lý sinh viên và tài khoản của bản thân.' }}
        </p>

        <div class="mt-4">
            <a href="{{ route('lophoc.index') }}" class="btn btn-primary me-2">
                Quản lý lớp học
            </a>
            <a href="{{ route('sinhvien.index') }}" class="btn btn-outline-primary me-2">
                Quản lý sinh viên
            </a>
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                Tài khoản của tôi
            </a>
        </div>
    </div>
@endsection
