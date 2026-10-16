@extends('layouts.layoutmaster')
@section('title', 'Quản lý người dùng')

@push('styles')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
            white-space: nowrap;
        }

        th a {
            color: inherit;
            text-decoration: none;
        }

        th a:hover {
            text-decoration: underline;
        }

        .filter-box {
            background: #fafcff;
            border: 1px solid #e1e8f0;
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .badge-role-admin {
            background-color: #7952b3;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-role-giang_vien {
            background-color: #0d6efd;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Quản lý người dùng</h1>
        <a href="{{ route('user.create') }}" class="btn btn-primary">+ Thêm người dùng mới</a>
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

    {{-- Bộ lọc: form GET --}}
    <form action="{{ route('user.index') }}" method="GET" class="filter-box">
        <input type="hidden" name="sort" value="{{ $sort }}">
        <input type="hidden" name="direction" value="{{ $direction }}">

        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="keyword" class="form-label">Từ khóa</label>
                <input type="text" id="keyword" name="keyword" class="form-control"
                       placeholder="Họ tên, email, số điện thoại..." value="{{ $filters['keyword'] ?? '' }}">
            </div>
            <div class="col-md-3">
                <label for="role" class="form-label">Vai trò</label>
                <select id="role" name="role" class="form-select">
                    <option value="">-- Tất cả vai trò --</option>
                    @foreach ($roles as $key => $label)
                        <option value="{{ $key }}" @selected(($filters['role'] ?? '') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="trang_thai" class="form-label">Trạng thái</label>
                <select id="trang_thai" name="trang_thai" class="form-select">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="1" @selected(($filters['trang_thai'] ?? '') === '1')>Hoạt động</option>
                    <option value="0" @selected(($filters['trang_thai'] ?? '') === '0')>Bị khóa</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="perPage" class="form-label">Số dòng / trang</label>
                <select id="perPage" name="perPage" class="form-select" onchange="this.form.submit()">
                    @foreach ($perPageOptions as $option)
                        <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lọc</button>
                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Xóa lọc</a>
            </div>
        </div>
    </form>

    <p>Tìm thấy <strong>{{ $users->total() }}</strong> tài khoản người dùng.</p>

    @php
        $columns = [
            'id' => 'ID',
            'name' => 'Họ và tên',
            'email' => 'Email',
            'role' => 'Vai trò',
            'so_dien_thoai' => 'Số điện thoại',
            'trang_thai' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
        ];
    @endphp

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    @foreach ($columns as $column => $label)
                        <th>
                            @if (in_array($column, $sortable))
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => $column,
                                    'direction' => $sort === $column && $direction === 'asc' ? 'desc' : 'asc',
                                    'page' => null,
                                ]) }}">
                                    {{ $label }}
                                    @if ($sort === $column)
                                        {{ $direction === 'asc' ? '▲' : '▼' }}
                                    @endif
                                </a>
                            @else
                                {{ $label }}
                            @endif
                        </th>
                    @endforeach
                    <th style="width: 160px;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $u)
                    <tr>
                        <td>{{ $u->id }}</td>
                        <td>
                            <a href="{{ route('user.show', $u) }}" class="fw-bold text-decoration-none">
                                {{ $u->name }}
                            </a>
                            @if ($u->id === auth()->id())
                                <span class="badge bg-secondary ms-1">Bạn</span>
                            @endif
                        </td>
                        <td>{{ $u->email }}</td>
                        <td>
                            @if ($u->isAdmin())
                                <span class="badge-role-admin">Quản trị viên (Admin)</span>
                            @else
                                <span class="badge-role-giang_vien">Giảng viên</span>
                            @endif
                        </td>
                        <td>{{ $u->so_dien_thoai ?: '-' }}</td>
                        <td>
                            @if ($u->trang_thai)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-danger">Bị khóa</span>
                            @endif
                        </td>
                        <td>{{ $u->created_at ? $u->created_at->format('d/m/Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('user.edit', $u) }}" class="btn btn-sm btn-primary">Sửa</a>
                            @if ($u->id !== auth()->id())
                                <form action="{{ route('user.destroy', $u) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản {{ $u->name }} không?')">
                                        Xóa
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn btn-sm btn-secondary" disabled title="Không thể tự xóa bản thân">Xóa</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + 1 }}" class="text-center py-4">Không có tài khoản nào phù hợp.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
@endsection
