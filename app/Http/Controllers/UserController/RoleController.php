<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\RoleStoreRequest;
use App\Http\Requests\UserRequests\RoleUpdateRequest;
use App\Models\user\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function index(): View|Factory|Application
    {
        $roles = Role::where('deleted', false)->paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    public function create(): View|Factory|Application
    {
        return view('roles.create');
    }

    public function store(RoleStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        Role::create($validatedData);
        return response()->json(['message' => 'Rôle crée avec succès']);
    }

    public function edit(Role $role): View|Factory|Application
    {
        return view('roles.edit', compact('role'));
    }

    public function update(RoleUpdateRequest $request, Role $role): JsonResponse
    {
        $validatedData = $request->validated();
        $role->update($validatedData);
        return response()->json(['message' => 'Rôle mise à jour avec succès']);
    }

    public function updateDeleted(int $id): JsonResponse
    {
        $role= Role::findOrFail($id);
        $role->deleted = true;
        $role->save();
        return response()->json(['message' => 'Rôle supprimé avec succès ']);
    }


    public function destroy( Role $role): RedirectResponse
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
