<?php

namespace App\Http\Controllers;

use App\library\firebirdDB;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function login(Request $request){
        $firebird = new firebirdDB();
        $postDB = $firebird->exdel();
        $sql = "select * from KRSWEB_SIGNIN($request->login, '$request->password')";
        $requestFB = ibase_query($sql);
        $rc = ibase_fetch_object($requestFB);
        $email = $rc->DVEMAIL;
        if ($email == '')
            $email = "post@post-master.ru";
        $name = iconv("windows-1251", "UTF-8",$rc->DVNAME);
        $licenses = 1;
        ibase_close($postDB);
        if ($rc->RSTATUS == 2)
        {
            return redirect()->back()->with('alert', 'Пользователь не зарегистрирован!');
        }
        if ($rc->RSTATUS == 0)
        {
            return redirect()->back()->with('alert', 'Неверный пароль!');
        }
        if ($rc->RSTATUS == 1)
        {
            $user = User::whereGb_id($request->login)->first();
            if ($user)
            {
                if ($user->managerMail != $email){
                    $user->managerMail = $email;
                    $user->save();
                }
                $credentials = ['gb_id' => $request->login, 'password' => $request->password];
                if (isset($request->rememberMe))
                    $remember = true;
                else
                    $remember = false;
                if (Auth::attempt($credentials,$remember)) {
                    return redirect()->route('home');
                } else {
                    return redirect()->back()->with('alert', "Неверные данные");
                }
            }
            else
            {

                $user = new User();
                $user->name = $name;
                $user->managerMail = $email;
                $user->gb_id = $request->login;
                $user->password = Hash::make($request->password);
                $user->save();
                if (isset($request->rememberMe))
                    $remember = true;
                else
                    $remember = false;
                Auth::login($user, $remember);
                return redirect()->route('home');
            }
        }
        return true;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');

    }
}
