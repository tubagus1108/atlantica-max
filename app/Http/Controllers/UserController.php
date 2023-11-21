<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function information(Request $request)
    {
        if ($request->session()->get('user')) {
            return view('users.information');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function showResetForm()
    {
        return view('auth.reset_password');
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_old' => 'required',
            'password' => 'required|confirmed|min:8', // 'confirmed' akan mencocokkan password dengan password_confirmation field
        ]);
        // dd($validator);
        if ($validator->fails()) {
            return redirect(route('reset.password'))
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->session()->get('user')) {
            $user = $request->session()->get('user');
            if ($request->input('password_old') !== $user->passwd) {
                return redirect()->back()->withErrors(['errors' => 'The old password is incorrect.']);
            }

            $gm_member = DB::connection('member')->table('dbo.GM_MEMBER')
                ->where('user_id', $user->user_id)
                ->update([
                    'passwd' => $request->input('password'),
                    'pwdmd5' => md5($request->input('password'))
                ]);

            if (!$gm_member) {
                return redirect()->back()->withErrors(['errors' => 'Internal server error.']);
            }
            return redirect()->route('user.information')->with('success', 'Password has been changed successfully.');
        } else {
            return redirect(route('reset.password'))
                ->withErrors(['error' => 'Not Authenticate'])
                ->withInput();
        }
    }
}
