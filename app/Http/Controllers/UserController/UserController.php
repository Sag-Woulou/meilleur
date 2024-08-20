<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\UserStoreRequest;
use App\Http\Requests\UserRequests\UserUpdateRequest;
use App\Models\user\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

/**
 * @method authorize(string $string, User $user)
 */
class UserController extends Controller
{
    public function index(): View|Factory|Application
    {
        $users = User::where('deleted', false)->paginate(10);
        return view('admin.index', compact('users'));
    }

    public function create(): View|Factory|Application
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $request):JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return response()->json(['message' => 'Utilisateur créé avec succès']);
    }



    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $validatedData = $request->validated();
        $user->update($validatedData);
        return response()->json(['message' => 'Utilisateur mis à jour avec succès']);
    }

    public function updateDeleted(int $id): JsonResponse
    {
        $user= User::findOrFail($id);
        $user->deleted = true;
        $user->save();
        return response()->json(['message' => 'Utilisateur mis à jour avec succès et marqué comme supprimé']);
    }


    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);
        $user->delete();
        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    }

}
