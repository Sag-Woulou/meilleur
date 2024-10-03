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

    public function login(){
        return view('auth.login');
    }

    public function dashboard(): View|Factory|Application
    {
        $user = auth()->user();
        $utilisateurs = $user->role->pluck('id');

        if($user->role_id == 4) {
            $users = User::with('roles')->where('deleted', false)->paginate(10);
            $roles = Role::with('permissions')->has('permissions')->get();
        }else{
            $users = User::with('roles')->where('deleted', false)->paginate(10);
            $roles = Role::with('permissions')->whereHas('permissions')->where('id', '!=', 4)
            ->get();

        }

        return view('admin.index', compact('users', 'roles'));
    }


    public function users(): Factory|View|Application
    {
    $user = auth()->user();

    if ($user->role && strtolower($user->role->name) === 'chef') {
        // Si c'est un chef, filtrer uniquement les agents et superviseurs
        $roles = Role::whereIn('name', ['agent', 'superviseur'])->get();
        $users = User::whereIn('role_id', $roles->pluck('id'))
            ->where('deleted', false)
            ->paginate(10);
    } elseif ($user->role && strtolower($user->role->name) === 'administrateur') {
        // Si c'est un administrateur, afficher tous les utilisateurs
        $users = User::where('deleted', false)
            ->paginate(10);
        $roles = Role::all(); // Ajouter cette ligne pour récupérer tous les rôles
    } else {
        // Pour tout autre rôle
        return redirect()->route('home')->with('error', 'Accès refusé');
    }

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

    private function jwt(User $user)
    {
      $payload = [
          'iss' => "gestion-ticket-jwt",
          'sub' => $user->id,
          'iat' => time(),
          'exp' => time() + 60 * 60,
          'user' => $user,
          'role' => $user->role->libelle

      ] ;
      //return JWT::encode($payload, env('JWT_SECRET'));
      return null;
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => time() + 60 * 60
        ]);
    }


}
