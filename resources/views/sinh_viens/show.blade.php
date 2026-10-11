@extends('layouts.layoutmaster')
@section('title', 'Chi tiết sinh viên: ' . $sinhVien->ho_ten)

@section('content')
    <h1>Chi tiết sinh viên</h1>

    <table class="table table-bordered mt-3" style="max-width: 800px;">
        <tr>
            <th style="width: 200px;">Mã sinh viên</th>
            <td><strong>{{ $sinhVien->ma_sinh_vien }}</strong></td>
        </tr>
        <tr>
            <th>Họ và tên</th>
            <td>{{ $sinhVien->ho_ten }}</td>
        </tr>
        <tr>
            <th>Lớp học</th>
            <td>
                @if ($sinhVien->lopHoc)
                    <a href="{{ route('lophoc.show', $sinhVien->lopHoc) }}">{{ $sinhVien->lopHoc->ten_lop }} ({{ $sinhVien->lopHoc->ma_lop }})</a>
                @else
                    <span class="text-muted">Chưa xếp lớp</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Ngày sinh</th>
            <td>{{ $sinhVien->ngay_sinh ? $sinhVien->ngay_sinh->format('d/m/Y') : 'Chưa cập nhật' }}</td>
        </tr>
        <tr>
            <th>Giới tính</th>
            <td>{{ $sinhVien->gioi_tinh ? 'Nam' : 'Nữ' }}</td>
        </tr>
        <tr>
            <th>Số điện thoại</th>
            <td>{{ $sinhVien->so_dien_thoai ?? 'Chưa cập nhật' }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $sinhVien->email ?? 'Chưa cập nhật' }}</td>
        </tr>
        <tr>
            <th>Địa chỉ</th>
            <td>{{ $sinhVien->dia_chi ?? 'Chưa cập nhật' }}</td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>
                @if ($sinhVien->trang_thai)
                    <span class="badge bg-success">Đang học</span>
                @else
                    <span class="badge bg-secondary">Tạm dừng / Thôi học</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $sinhVien->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <div class="mt-3">
        <a href="{{ route('sinhvien.edit', $sinhVien) }}" class="btn btn-primary">Sửa sinh viên</a>
        <a href="{{ route('sinhvien.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
@endsection
