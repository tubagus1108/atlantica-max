<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function indexRegister(Request $request)
    {
        if($request->session()->get('user')){
            return redirect(route('home.index'));
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|max:20|unique:member.dbo.GM_MEMBER',
            'first_name' => 'required|string|max:32',
            'email' => 'required|string|email|max:50|unique:member.dbo.GM_MEMBER',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'birthday' => 'required|string',
            'terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect(route('register.index'))
                ->withErrors($validator)
                ->withInput();
        }

        $birthday = date('d/m/y', strtotime($request->input('birthday')));
        $gender = ($request->input('gender') == 'male') ? 'm' : 'f';

        DB::connection('member')->table('dbo.GM_MEMBER')->insert([
            'user_id' => $request->input('user_id'),
            'f_name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'passwd' => md5($request->input('password')),
            'user_birthday' => $birthday,
            'user_gender' => $gender,
            'reg_date' => Carbon::now(),
            'reg_ip' => $request->ip(),
            // Add other columns as needed
        ]);

        $user = [
            'email' => $request->input('email'),
            'passwd' => md5($request->input('password')),
        ];

        if (Auth::attempt($user)) {
            session(['user' => Auth::user()]);
            return redirect(route('home.index'))->with('success', 'Registration successful!');
        } else {
            return redirect(route('login.index'))->withErrors(['errors' => 'Registration errors!']);
        }
    }

    public function indexLogin(Request $request)
    {
        if ($request->session()->get('user')) {
            return redirect(route('home.index'));
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identify' => 'required',
            'password' => 'required',
        ]);
        // dd($validator);
        if ($validator->fails()) {
            return redirect(route('login.index'))
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'user_id' => $request->input('identify'),
            'passwd' => md5($request->input('password')),
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            DB::connection('member')->table('dbo.GM_MEMBER')
                ->where('user_id', $user->user_id) // Ganti $userId dengan nilai user_id yang sesuai
                ->update([
                    'login_date' => Carbon::now(), // Mengupdate login_date dengan timestamp saat ini
                    'login_ip'   => $request->ip(), // Ganti $userIp dengan alamat IP yang sesuai
                ]);
            
            session()->put('user', $user);
            return redirect(route('home.index'));
        } else {
            return redirect(route('login.index'))->withErrors(['errors' => 'Incorrect username or password']);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->session()->get('user');
        // dd($user['user_id']);
        DB::connection('member')->table('dbo.GM_MEMBER')
            ->where('user_id', $user->user_id) // Ganti $userId dengan nilai user_id yang sesuai
            ->update([
                'out_date' => Carbon::now(), // Mengupdate login_date dengan timestamp saat ini
                'out_ip'   => $request->ip(), // Ganti $userIp dengan alamat IP yang sesuai
        ]);
        Session::flush();
        Session::forget('user');

        return redirect(route('login.index'));
    }
}
