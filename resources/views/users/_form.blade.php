{{-- Dùng chung cho create và edit. Khi sửa thì có biến $user, khi thêm mới thì không. --}}
@php($user = $user ?? null)

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
        <input type="text" id="name" name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user?->name) }}" required placeholder="Ví dụ: Nguyễn Văn A">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Địa chỉ Email <span class="text-danger">*</span></label>
        <input type="email" id="email" name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user?->email) }}" required placeholder="email@huce.edu.vn">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="role" class="form-label">Vai trò <span class="text-danger">*</span></label>
        <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
            @foreach ($roles as $key => $label)
                <option value="{{ $key }}" @selected(old('role', $user?->role ?? \App\Models\User::ROLE_GIANG_VIEN) === $key)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <div class="form-text">
            <strong>Admin:</strong> Toàn quyền hệ thống. <strong>Giảng viên:</strong> Chỉ quản lý lớp học, sinh viên và tài khoản bản thân.
        </div>
        @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
        <input type="text" id="so_dien_thoai" name="so_dien_thoai"
               class="form-control @error('so_dien_thoai') is-invalid @enderror"
               value="{{ old('so_dien_thoai', $user?->so_dien_thoai) }}" placeholder="Ví dụ: 0912345678">
        @error('so_dien_thoai')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="trang_thai" class="form-label">Trạng thái tài khoản <span class="text-danger">*</span></label>
    <select id="trang_thai" name="trang_thai" class="form-select @error('trang_thai') is-invalid @enderror">
        <option value="1" @selected(old('trang_thai', $user?->trang_thai ?? 1) == 1)>Hoạt động</option>
        <option value="0" @selected(old('trang_thai', $user?->trang_thai ?? 1) == 0)>Khóa tài khoản</option>
    </select>
    @error('trang_thai')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<hr class="my-3">

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="password" class="form-label">
            Mật khẩu @if (!$user) <span class="text-danger">*</span> @else <small class="text-muted">(Bỏ trống nếu không đổi)</small> @endif
        </label>
        <input type="password" id="password" name="password"
               class="form-control @error('password') is-invalid @enderror"
               @if (!$user) required @endif placeholder="Tối thiểu 6 ký tự">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="password_confirmation" class="form-label">
            Xác nhận mật khẩu @if (!$user) <span class="text-danger">*</span> @endif
        </label>
        <input type="password" id="password_confirmation" name="password_confirmation"
               class="form-control"
               @if (!$user) required @endif placeholder="Nhập lại mật khẩu">
    </div>
</div>
