{{-- Dùng chung cho create và edit. Khi sửa thì có biến $sinhVien, khi thêm mới thì không. --}}
@php($sinhVien = $sinhVien ?? null)

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="ho_ten" class="form-label">Họ và tên <span class="text-danger">*</span></label>
        <input type="text" id="ho_ten" name="ho_ten"
               class="form-control @error('ho_ten') is-invalid @enderror"
               value="{{ old('ho_ten', $sinhVien?->ho_ten) }}" placeholder="Ví dụ: Nguyễn Văn An">
        @error('ho_ten')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="ma_sinh_vien" class="form-label">Mã sinh viên <span class="text-danger">*</span></label>
        <input type="text" id="ma_sinh_vien" name="ma_sinh_vien"
               class="form-control @error('ma_sinh_vien') is-invalid @enderror"
               value="{{ old('ma_sinh_vien', $sinhVien?->ma_sinh_vien) }}" placeholder="Ví dụ: SV001">
        <div class="form-text">Mã sinh viên không được trùng với sinh viên khác.</div>
        @error('ma_sinh_vien')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="lop_hoc_id" class="form-label">Lớp học <span class="text-danger">*</span></label>
        <select id="lop_hoc_id" name="lop_hoc_id"
                class="form-select @error('lop_hoc_id') is-invalid @enderror">
            <option value="">-- Chọn lớp học --</option>
            @foreach ($lopHocs as $lop)
                <option value="{{ $lop->id }}" @selected(old('lop_hoc_id', $sinhVien?->lop_hoc_id) == $lop->id)>
                    {{ $lop->ten_lop }} ({{ $lop->ma_lop }})
                </option>
            @endforeach
        </select>
        @error('lop_hoc_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label for="ngay_sinh" class="form-label">Ngày sinh</label>
        <input type="date" id="ngay_sinh" name="ngay_sinh"
               class="form-control @error('ngay_sinh') is-invalid @enderror"
               value="{{ old('ngay_sinh', $sinhVien?->ngay_sinh?->format('Y-m-d')) }}">
        @error('ngay_sinh')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label for="gioi_tinh" class="form-label">Giới tính <span class="text-danger">*</span></label>
        <select id="gioi_tinh" name="gioi_tinh"
                class="form-select @error('gioi_tinh') is-invalid @enderror">
            <option value="1" @selected(old('gioi_tinh', $sinhVien?->gioi_tinh ?? 1) == 1)>Nam</option>
            <option value="0" @selected(old('gioi_tinh', $sinhVien?->gioi_tinh ?? 1) == 0)>Nữ</option>
        </select>
        @error('gioi_tinh')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
        <input type="text" id="so_dien_thoai" name="so_dien_thoai"
               class="form-control @error('so_dien_thoai') is-invalid @enderror"
               value="{{ old('so_dien_thoai', $sinhVien?->so_dien_thoai) }}" placeholder="Ví dụ: 0987654321">
        @error('so_dien_thoai')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $sinhVien?->email) }}" placeholder="Ví dụ: sv@huce.edu.vn">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="dia_chi" class="form-label">Địa chỉ</label>
    <textarea id="dia_chi" name="dia_chi" rows="2"
              class="form-control @error('dia_chi') is-invalid @enderror"
              placeholder="Nhập địa chỉ / quê quán...">{{ old('dia_chi', $sinhVien?->dia_chi) }}</textarea>
    @error('dia_chi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="trang_thai" class="form-label">Trạng thái <span class="text-danger">*</span></label>
    <select id="trang_thai" name="trang_thai"
            class="form-select @error('trang_thai') is-invalid @enderror">
        <option value="1" @selected(old('trang_thai', $sinhVien?->trang_thai ?? 1) == 1)>Đang học</option>
        <option value="0" @selected(old('trang_thai', $sinhVien?->trang_thai ?? 1) == 0)>Tạm dừng / Thôi học</option>
    </select>
    @error('trang_thai')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
