@push('styles')
<style>
    .header {
      background: var(--c-header);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      position: sticky;
      top: 0;
      z-index: 10;
      min-height: 64px;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 32px;
    }

    .header .logo {
      font-size: 20px;
      font-weight: 700;
      letter-spacing: 0.5px;
      white-space: nowrap;
    }

    .header .logo a {
      color: #fff;
      text-decoration: none;
    }

    .header .logo span {
      color: var(--c-accent);
    }

    .header nav ul {
      display: flex;
      gap: 20px;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .header nav a {
      color: #d9e4f0;
      text-decoration: none;
      font-size: 15px;
      padding: 6px 4px;
      border-bottom: 2px solid transparent;
      transition: color 0.2s, border-color 0.2s;
    }

    .header nav a:hover,
    .header nav a:focus {
      color: #fff;
      border-bottom-color: var(--c-accent);
    }

    .header-user {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .badge-role-admin {
      background-color: #845ef7;
      color: #fff;
      font-size: 11px;
      font-weight: 600;
      padding: 3px 8px;
      border-radius: 12px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .badge-role-giang_vien {
      background-color: #20c997;
      color: #fff;
      font-size: 11px;
      font-weight: 600;
      padding: 3px 8px;
      border-radius: 12px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .user-name {
      font-size: 14px;
      font-weight: 500;
      color: #fff;
    }

    .btn-header-profile {
      color: #d9e4f0;
      text-decoration: none;
      font-size: 13px;
      padding: 4px 8px;
      border-radius: 4px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: background 0.2s, color 0.2s;
    }

    .btn-header-profile:hover {
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
    }

    .btn-header-logout {
      background: rgba(239, 68, 68, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.4);
      color: #fca5a5;
      font-size: 13px;
      padding: 4px 10px;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .btn-header-logout:hover {
      background: #ef4444;
      color: #fff;
    }
</style>
@endpush

<header class="header">
    <div class="header-left">
        <div class="logo"><a href="{{ route('lophoc.index') }}">HUCE<span>.Web</span></a></div>
        <nav>
            <ul>
                @foreach (($menuHienThi ?? collect())->get('header', []) as $menu)
                    <li><a href="{{ $menu->url }}">{{ $menu->ten }}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>

    @auth
        <div class="header-user">
            <span class="user-name">{{ auth()->user()->name }}</span>
            @if (auth()->user()->isAdmin())
                <span class="badge-role-admin">Admin</span>
            @else
                <span class="badge-role-giang_vien">Giảng viên</span>
            @endif

            <a href="{{ route('profile.edit') }}" class="btn-header-profile" title="Quản lý tài khoản">
                Tài khoản
            </a>

            <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                @csrf
                <button type="submit" class="btn-header-logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?')">
                    Đăng xuất
                </button>
            </form>
        </div>
    @else
        <div>
            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Đăng nhập</a>
        </div>
    @endauth
</header>