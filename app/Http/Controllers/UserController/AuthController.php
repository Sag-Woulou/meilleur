<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\LoginRequest;
use App\Models\user\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(){
        return view('auth.login');
    }

    public function dashboard(): View|Factory|Application
    {
        $users = User::where('deleted', false)->paginate(10);
        return view('admin.index', compact('users'));
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
}
