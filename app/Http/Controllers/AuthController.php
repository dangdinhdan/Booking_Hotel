<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('lophoc.index');
        }

        return view('auth.login');
    }

    /**
     * Xử lý xác thực và đăng nhập người dùng.
     */
    public function login(Request $request)
    {
        $input = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required' => 'Vui lòng nhập Email hoặc Số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $throttleKey = Str::transliterate(Str::lower($input['email']) . '|' . $request->ip());

        // Chống brute-force: khóa tạm thời 60s nếu nhập sai quá 5 lần
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()->withErrors([
                'email' => "Bạn đã thử đăng nhập sai quá nhiều lần. Vui lòng thử lại sau {$seconds} giây.",
            ])->onlyInput('email');
        }

        $account = trim($input['email']);
        $password = $input['password'];
        $remember = $request->boolean('remember');

        // Xác định đăng nhập qua Email hay Số điện thoại
        $field = filter_var($account, FILTER_VALIDATE_EMAIL) ? 'email' : 'so_dien_thoai';
        $credentials = [$field => $account, 'password' => $password];

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($throttleKey);

            $user = Auth::user();

            // Kiểm tra trạng thái hoạt động của tài khoản
            if (!$user->trang_thai) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Tài khoản của bạn hiện đang bị khóa. Vui lòng liên hệ Quản trị viên để được hỗ trợ.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            $defaultRoute = route('lophoc.index');

            return redirect()->intended($defaultRoute)
                ->with('success', 'Đăng nhập thành công! Chào mừng ' . $user->name . ' (' . $user->role_name . ').');
        }

        // Tăng số lần thử sai
        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác. Vui lòng kiểm tra lại Email/Số điện thoại và Mật khẩu.',
        ])->onlyInput('email');
    }

    /**
     * Xử lý đăng xuất tài khoản.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất khỏi hệ thống thành công.');
    }
}
