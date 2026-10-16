@extends('layouts.layoutmaster')
@section('title', 'Chi tiết người dùng: ' . $user->name)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Chi tiết người dùng</h1>
        <div>
            <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">Chỉnh sửa</a>
            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Quay lại danh sách</a>
        </div>
    </div>

    <div class="card" style="max-width: 700px;">
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr>
                    <th style="width: 200px;" class="bg-light">ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Họ và tên</th>
                    <td><strong>{{ $user->name }}</strong></td>
                </tr>
                <tr>
                    <th class="bg-light">Địa chỉ Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Vai trò</th>
                    <td>
                        @if ($user->isAdmin())
                            <span class="badge bg-primary">Quản trị viên (Admin)</span>
                        @else
                            <span class="badge bg-success">Giảng viên</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="bg-light">Số điện thoại</th>
                    <td>{{ $user->so_dien_thoai ?: 'Chưa cập nhật' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Trạng thái</th>
                    <td>
                        @if ($user->trang_thai)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-danger">Bị khóa</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="bg-light">Ngày tạo</th>
                    <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Lần cập nhật cuối</th>
                    <td>{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
