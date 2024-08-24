<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\UserRoleStoreRequest;
use App\Http\Requests\UserRequests\UserStoreRequest;
use App\Http\Requests\UserRequests\UserUpdateRequest;
use App\Models\user\Role;
use App\Models\user\User;
use App\Models\UserRole;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * @method authorize(string $string, User $user)
 */
class UserController extends Controller
{
    public function index(): View|Factory|Application
    {
        $users = User::where('deleted', false)->paginate(10);
        $roles = Role::with('permissions')->has('permissions')->get();
        return view('admin.index', compact('users', 'roles'));
    }


    public function create(): View|Factory|Application
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $userRequest, UserRoleStoreRequest $roleRequest): JsonResponse
    {
        DB::beginTransaction();
        try {
            $validatedUserData = $userRequest->validated();
            $validatedUserData['password'] = Hash::make($validatedUserData['password']);
            $user = User::create($validatedUserData);
            $validatedRoleData = $roleRequest->validated();
            $validatedRoleData['user_id'] = $user->id;
            UserRole::create($validatedRoleData);
            DB::commit();
            return response()->json(['message' => 'Utilisateur et rôle créés avec succès', 'user_id' => $user->id], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erreur lors de la création de l\'utilisateur ou de l\'attribution du rôle: ' . $e->getMessage()], 500);
        }
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
