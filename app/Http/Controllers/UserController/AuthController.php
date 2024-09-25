<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\LoginRequest;
use App\Models\user\Role;
use App\Models\user\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class AuthController extends Controller implements HasMiddleware
{
    function __construct (){
       // $this->middleware('isAuth');
    }

    public function login(){
        return view('auth.login');
    }

    public function dashboard(): View|Factory|Application
    {

        $users = User::with('roles')->where('deleted', false)->paginate(10);
        $roles = Role::with('permissions')->has('permissions')->get();
        return view('admin.index', compact('users', 'roles'));
    }


    public function users(): View|Factory|Application
    {

        $users = User::with('roles')->where('deleted', false)->paginate(10);
        $roles = Role::with('permissions')->has('permissions')->get();
        return view('users.listUser', compact('users', 'roles'));
    }



    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.index');
        }

        return back()->withErrors([
            'name' => 'Identifiants incorrects.',
        ])->onlyInput('username');
    }
    function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.

        return [
            //'isAuth',
           // new Middleware('log', only: ['index']),
            //new Middleware('subscribed', except: ['store']),
        ];
    }
}
