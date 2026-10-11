@extends('layouts.layoutmaster')
@section('title', 'Chi tiết lớp học: ' . $lopHoc->ten_lop)

@section('content')
    <h1>Chi tiết lớp học: {{ $lopHoc->ten_lop }}</h1>

    <table class="table table-bordered" style="max-width: 800px;">
        <tr><th style="width: 220px">ID</th><td>{{ $lopHoc->id }}</td></tr>
        <tr><th>Tên lớp</th><td>{{ $lopHoc->ten_lop }}</td></tr>
        <tr><th>Mã lớp</th><td>{{ $lopHoc->ma_lop }}</td></tr>
        <tr><th>Giáo viên</th><td>{{ $lopHoc->giao_vien }}</td></tr>
        <tr><th>Số điện thoại GVCN</th><td>{{ $lopHoc->so_dien_thoai_gvcn ?? 'Chưa cập nhật' }}</td></tr>
        <tr><th>Ghi chú</th><td>{{ $lopHoc->ghi_chu ?? 'Không có' }}</td></tr>
        <tr><th>Sĩ số</th><td>{{ $lopHoc->si_so }}</td></tr>
        <tr><th>Trạng thái</th><td>{{ $lopHoc->trang_thai ? 'Hoạt động' : 'Không hoạt động' }}</td></tr>
    </table>

    <div class="mb-4">
        <a href="{{ route('lophoc.edit', $lopHoc) }}" class="btn btn-primary">Sửa lớp học</a>
        <a href="{{ route('lophoc.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách sinh viên trong lớp ({{ $lopHoc->sinhViens->count() }})</h3>
        <a href="{{ route('sinhvien.create') }}" class="btn btn-sm btn-success">+ Thêm sinh viên</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Mã SV</th>
                <th>Họ và tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Số ĐT</th>
                <th>Email</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lopHoc->sinhViens as $sv)
                <tr>
                    <td><strong>{{ $sv->ma_sinh_vien }}</strong></td>
                    <td><a href="{{ route('sinhvien.show', $sv) }}">{{ $sv->ho_ten }}</a></td>
                    <td>{{ $sv->gioi_tinh ? 'Nam' : 'Nữ' }}</td>
                    <td>{{ $sv->ngay_sinh ? $sv->ngay_sinh->format('d/m/Y') : '' }}</td>
                    <td>{{ $sv->so_dien_thoai }}</td>
                    <td>{{ $sv->email }}</td>
                    <td>{{ $sv->trang_thai ? 'Đang học' : 'Tạm dừng' }}</td>
                    <td>
                        <a href="{{ route('sinhvien.show', $sv) }}" class="btn btn-sm btn-info text-white">Xem</a>
                        <a href="{{ route('sinhvien.edit', $sv) }}" class="btn btn-sm btn-primary">Sửa</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted">Lớp học này hiện chưa có sinh viên nào.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
