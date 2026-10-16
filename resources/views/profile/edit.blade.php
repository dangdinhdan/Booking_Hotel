@extends('layouts.layoutmaster')
@section('title', 'Quản lý tài khoản của bản thân')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Quản lý tài khoản của bản thân</h1>
        <div>
            @if ($user->isAdmin())
                <span class="badge bg-primary px-3 py-2 fs-6">Vai trò: Quản trị viên (Admin)</span>
            @else
                <span class="badge bg-success px-3 py-2 fs-6">Vai trò: Giảng viên</span>
            @endif
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card mb-4" style="max-width: 700px;">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary">Thông tin cá nhân & Đổi mật khẩu</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Vai trò trong hệ thống</label>
                    <input type="text" class="form-control" value="{{ $user->role_name }}" disabled readonly>
                    <div class="form-text">
                        @if ($user->isAdmin())
                            Bạn có toàn quyền quản trị hệ thống, bao gồm quản lý người dùng, menu, lớp học và sinh viên.
                        @else
                            Bạn có quyền quản lý lớp học, sinh viên và tài khoản của chính mình.
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Địa chỉ Email <span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                    <input type="text" id="so_dien_thoai" name="so_dien_thoai"
                           class="form-control @error('so_dien_thoai') is-invalid @enderror"
                           value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}" placeholder="Ví dụ: 0912345678">
                    @error('so_dien_thoai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">

                <h6 class="text-secondary mb-3">Đổi mật khẩu (bỏ trống nếu không muốn đổi)</h6>

                <div class="mb-3">
                    <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" id="current_password" name="current_password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           placeholder="Nhập mật khẩu hiện tại nếu đổi mật khẩu mới">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Mật khẩu mới</label>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Tối thiểu 6 ký tự">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control"
                               placeholder="Nhập lại mật khẩu mới">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <a href="{{ route('lophoc.index') }}" class="btn btn-outline-secondary">Quay lại trang chủ</a>
                </div>
            </form>
        </div>
    </div>
@endsection
