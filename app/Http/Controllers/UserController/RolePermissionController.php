<?php

namespace App\Http\Controllers\UserController;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\UserRequests\RolePermissionStoreRequest;
use App\Http\Requests\UserRequests\RolePermissionUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    /**
     * Afficher la liste des rôles et permissions.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return response()->json([
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Enregistrer un nouveau rôle avec des permissions.
     *
     * @param RolePermissionStoreRequest $request
     * @return JsonResponse
     */
    public function store(RolePermissionStoreRequest $request): JsonResponse
    {
        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->permissions()->attach($request->permissions);

        return response()->json([
            'message' => 'Rôle et permissions créés avec succès.',
            'role' => $role->load('permissions'),
        ], 201);
    }

    /**
     * Afficher un rôle spécifique avec ses permissions.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role): JsonResponse
    {
        return response()->json([
            'role' => $role->load('permissions'),
        ]);
    }

    /**
     * Mettre à jour un rôle existant avec ses permissions.
     *
     * @param RolePermissionUpdateRequest $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(RolePermissionUpdateRequest $request, Role $role): JsonResponse
    {
        $role->update([
            'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions);

        return response()->json([
            'message' => 'Rôle et permissions mis à jour avec succès.',
            'role' => $role->load('permissions'),
        ]);
    }

    /**
     * Supprimer un rôle et dissocier ses permissions.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->permissions()->detach();
        $role->delete();

        return response()->json([
            'message' => 'Rôle supprimé avec succès.',
        ]);
    }

    /**
     * Lister toutes les permissions disponibles.
     *
     * @return JsonResponse
     */
    public function listPermissions(): JsonResponse
    {
        $permissions = Permission::all();

        return response()->json([
            'permissions' => $permissions,
        ]);
    }

    /**
     * Ajouter une nouvelle permission.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addPermission(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions|max:255',
            'description' => 'nullable|string',
        ]);

        $permission = Permission::create($validated);

        return response()->json([
            'message' => 'Permission ajoutée avec succès.',
            'permission' => $permission,
        ], 201);
    }

    /**
     * Supprimer une permission.
     *
     * @param Permission $permission
     * @return JsonResponse
     */
    public function deletePermission(Permission $permission): JsonResponse
    {
        $permission->delete();

        return response()->json([
            'message' => 'Permission supprimée avec succès.',
        ]);
    }
}
