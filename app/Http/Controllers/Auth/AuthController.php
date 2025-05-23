<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function indexRegister(Request $request)
    // {
    //     if ($request->session()->get('user')) {
    //         return redirect(route('home.index'));
    //     }
    //     return view('auth.register');
    // }

    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|string|max:20|unique:member.dbo.GM_MEMBER',
    //         'first_name' => 'required|string|max:32',
    //         'email' => 'required|string|email|max:50|unique:member.dbo.GM_MEMBER',
    //         'password' => 'required|string|min:8|confirmed',
    //         'gender' => 'required|string',
    //         'birthday' => 'required|string',
    //         'terms' => 'required|accepted',
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect(route('register.index'))
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $birthday = date('d/m/y', strtotime($request->input('birthday')));
    //     $gender = ($request->input('gender') == 'male') ? 'm' : 'f';

    //     DB::connection('member')->table('dbo.GM_MEMBER')->insert([
    //         'user_id' => $request->input('user_id'),
    //         'f_name' => $request->input('first_name'),
    //         'email' => $request->input('email'),
    //         'passwd' => $request->input('password'),
    //         'user_birthday' => $birthday,
    //         'user_gender' => $gender,
    //         'reg_date' => Carbon::now(),
    //         'reg_ip' => $request->ip(),
    //         // Add other columns as needed
    //     ]);

    //     $user = [
    //         'email' => $request->input('email'),
    //         'passwd' => $request->input('password'),
    //     ];

    //     if (Auth::attempt($user)) {
    //         return redirect(route('login.index'))->with('success', 'Registration successful!');
    //     } else {
    //         return redirect(route('login.index'))->withErrors(['errors' => 'Registration errors!']);
    //     }
    // }

    // public function indexLogin(Request $request)
    // {
    //     if ($request->session()->get('user')) {
    //         return redirect(route('home.index'));
    //     }
    //     return view('auth.login');
    // }

    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'identify' => 'required',
    //         'password' => 'required',
    //     ]);
    //     // dd($validator);
    //     if ($validator->fails()) {
    //         return redirect(route('login.index'))
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $data = [
    //         'user_id' => $request->input('identify'),
    //         'passwd' => $request->input('password'),
    //     ];

    //     $checkUser = DB::connection('account')->table('dbo.tbl_Account')
    //                 ->where('ID', $data['user_id'])
    //                 ->first();

    //     if($checkUser && Auth::attempt($data)){
    //         $check_role = DB::connection('account')->table('dbo.tbl_Account')
    //             ->where('ID', $data['user_id'])
    //             ->where('MasterLevelValue', '>', 109)
    //             ->where('MasterLevelExpireTime', '>=', Carbon::now())
    //             ->where('MasterLevel', '>', 109)
    //             ->first();
    //         if ($check_role) {
    //             session()->put('user', $checkUser);
    //             return redirect(route('admin.news'));
    //         } else {
    //             session()->put('user', $checkUser);
    //             return redirect(route('home.index'));
    //         }
    //     }else{
    //         return redirect(route('login.index'))->withErrors(['errors' => 'Account not found, please login to the game']);
    //     }
    // }

    // public function logout(Request $request)
    // {
    //     $user = $request->session()->get('user');

    //     if (!$user) {
    //         return redirect(route('login.index'));
    //     }
    //     // dd($user['user_id']);
    //     DB::connection('member')->table('dbo.GM_MEMBER')
    //         ->where('user_id', $user->{'ID'}) // Ganti $userId dengan nilai user_id yang sesuai
    //         ->update([
    //             'out_date' => Carbon::now(), // Mengupdate login_date dengan timestamp saat ini
    //             'out_ip'   => $request->ip(), // Ganti $userIp dengan alamat IP yang sesuai
    //         ]);
    //     Session::flush();
    //     Session::forget('user');

    //     return redirect(route('login.index'));
    // }

    // public function showResetForm(Request $request)
    // {
    //     // Ambil user_id dari sesi
    //     $user_id = $request->session()->get('user')->user_id;

    //     // Lakukan query ke database untuk mendapatkan email berdasarkan user_id
    //     $user = DB::table('GM_MEMBER')->where('user_id', $user_id)->first();

    //     // Jika user tidak ditemukan, redirect atau tampilkan pesan kesalahan
    //     if (!$user) {
    //         // Tambahkan log atau tampilkan pesan kesalahan
    //         return redirect()->back()->with('error', 'User tidak ditemukan.');
    //     }

    //     // Kirim email dengan tautan reset password
    //     // Mail::to($user->email)->send(new ResetPasswordEmail($user));

    //     // Redirect ke halaman reset password
    //     return redirect('/reset-password-form')->with('success', 'Tautan reset password telah dikirim ke email Anda.');
    // }

    // public function resetPasswordForm()
    // {
    //     // Tampilkan halaman form reset password
    //     return view('auth.reset-password');
    // }

    // public function resetPassword(Request $request)
    // {
    //     // Validasi input dari form reset password
    //     $request->validate([
    //         'new_password' => 'required|min:8',
    //         // tambahkan validasi lainnya sesuai kebutuhan
    //     ]);

    //     // Ambil user_id dari sesi
    //     $user_id = $request->session()->get('user')->user_id;

    //     // Lakukan update password berdasarkan user_id
    //     DB::table('GM_MEMBER')->where('user_id', $user_id)->update([
    //         'password' => bcrypt($request->input('new_password')),
    //     ]);

    //     // Redirect ke halaman login atau tampilkan pesan sukses
    //     return redirect('/login')->with('success', 'Password Anda telah direset.');
    // }
    public function indexRegister(Request $request)
    {
        if ($request->session()->has('user')) {
            return redirect(route('home.index'));
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|max:20|unique:member.dbo.GM_MEMBER,user_id',
            'first_name' => 'required|string|max:32',
            'email' => 'required|string|email|max:50|unique:member.dbo.GM_MEMBER,email',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|in:male,female',
            'birthday' => 'required|date',
            'terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect(route('register.index'))
                ->withErrors($validator)
                ->withInput();
        }

        $birthday = Carbon::parse($request->birthday)->format('d/m/y');
        $gender = $request->gender === 'male' ? 'm' : 'f';

        DB::connection('member')->table('dbo.GM_MEMBER')->insert([
            'user_id' => $request->user_id,
            'f_name' => $request->first_name,
            'email' => $request->email,
            'passwd' => $request->password,
            'user_birthday' => $birthday,
            'user_gender' => $gender,
            'reg_date' => Carbon::now(),
            'reg_ip' => $request->ip(),
        ]);

        return redirect(route('login.index'))->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function indexLogin(Request $request)
    {
        if ($request->session()->has('user')) {
            return redirect(route('home.index'));
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identify' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect(route('login.index'))->withErrors($validator)->withInput();
        }

        $user = DB::connection('account')->table('dbo.tbl_Account')
            ->where('ID', $request->identify)
            ->first();

        $member = DB::connection('member')->table('dbo.GM_MEMBER')
            ->where('user_id', $request->identify)
            ->first();

        if (!$user || $request->password !== $member->passwd) {
            return redirect(route('login.index'))->withErrors(['errors' => 'Akun tidak ditemukan atau password salah.']);
        }

        Session::invalidate();
        Session::regenerate();

        Session::put('user', [
            'id' => $user->ID,
            'cash'   => $user->cash ?? 0,
            'bond'   => $user->bond ?? 0,
        ]);

        $isSuperAdmin = DB::connection('account')->table('dbo.tbl_Account')
            ->where('ID', $user->ID)
            ->where('MasterLevelValue', '>', 109)
            ->where('MasterLevelExpireTime', '>=', Carbon::now())
            ->where('MasterLevel', '>', 109)
            ->exists();

        return redirect($isSuperAdmin ? route('admin.news') : route('home.index'));
    }

    public function logout(Request $request)
    {
        $sessionUser = $request->session()->get('user');

        if ($sessionUser && isset($sessionUser['id'])) {
            DB::connection('member')->table('dbo.GM_MEMBER')
                ->where('user_id', $sessionUser['id'])
                ->update([
                    'out_date' => Carbon::now(),
                    'out_ip' => $request->ip(),
                ]);
        }

        Session::flush();
        Session::invalidate();
        Session::regenerateToken();

        return redirect(route('login.index'));
    }

    public function showResetForm(Request $request)
    {
        $user_id = optional($request->session()->get('user'))['id'] ?? null;

        if (!$user_id) {
            return redirect()->back()->with('error', 'Sesi tidak valid.');
        }

        $user = DB::connection('member')->table('dbo.GM_MEMBER')
            ->where('user_id', $user_id)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Mail::to($user->email)->send(new ResetPasswordEmail($user));

        return redirect('/reset-password-form')->with('success', 'Tautan reset telah dikirim ke email Anda.');
    }

    public function resetPasswordForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user_id = optional($request->session()->get('user'))['id'] ?? null;

        if (!$user_id) {
            return redirect()->back()->withErrors(['error' => 'Sesi tidak valid.']);
        }

        DB::connection('member')->table('dbo.GM_MEMBER')
            ->where('user_id', $user_id)
            ->update([
                'passwd' => $request->new_password,
            ]);

        return redirect(route('login.index'))->with('success', 'Password berhasil direset.');
    }
}
