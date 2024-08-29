<?php

namespace App\Http\Controllers\UserController;

use App\Http\Requests\UserRequests\RolePermissionStoreRequest;
use App\Models\PermissionRole;
use App\Models\user\Role;
use App\Models\user\Permission;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolePermissionController extends Controller
{
    /**
     * Afficher la liste des rôles avec leurs permissions.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View|Factory|Application
    {
        $roles = Role::with('permissions')->has('permissions')->get();
        $permissions = Permission::where('deleted', 0)->get();
        $allRoles = Role::where('deleted', 0)->get();

        return view('admin.rolelier.index', compact('roles', 'permissions','allRoles'));
    }


    public function create(): View|Factory|Application
    {
        return view('rolelier.create');
    }
    /**
     * Enregistrer une nouvelle association entre un rôle et des permissions.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(RolePermissionStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $roleId = $validatedData['role_id'];
        $permissionIds = $validatedData['permission_id'];
        if (is_array($permissionIds)) {
            foreach ($permissionIds as $permissionId) {
                PermissionRole::updateOrCreate(
                    ['role_id' => $roleId, 'permission_id' => $permissionId],
                    ['updated_at' => now(), 'created_at' => now()]
                );
            }
        } else {
            PermissionRole::updateOrCreate(
                ['role_id' => $roleId, 'permission_id' => $permissionIds],
                ['updated_at' => now(), 'created_at' => now()]
            );
        }

        return response()->json(['message' => 'Permissions associées au rôle avec succès.'], 201);
    }


    /**
     * Afficher un rôle spécifique avec ses permissions.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $role = Role::with('permissions')->findOrFail($id);

        return response()->json([
            'role' => $role,
        ]);
    }

    /**
     * Mettre à jour les permissions associées à un rôle existant.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(RolePermissionStoreRequest $request, $roleId): JsonResponse
    {
        $validatedData = $request->validated();
        $permissionIds = $validatedData['permission_id'];
        if (!is_array($permissionIds)) {
            return response()->json(['error' => 'Invalid permissions data.'], 400);
        }
        PermissionRole::where('role_id', $roleId)->delete();
        foreach ($permissionIds as $permissionId) {
            PermissionRole::updateOrCreate(
                ['role_id' => $roleId, 'permission_id' => $permissionId],
                ['updated_at' => now(), 'created_at' => now()]
            );
        }

        return response()->json(['message' => 'Permissions mises à jour avec succès.'], 200);
    }


    /**
     * Supprimer un rôle et dissocier toutes ses permissions.
     *
     * @param int $roleId
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        $deleted = PermissionRole::where('role_id', $role->id)->delete();

        if ($deleted) {
            return response()->json(['message' => 'Relation supprimée avec succès.'], 200);
        } else {
            return response()->json(['error' => 'Relation non trouvée.'], 404);
        }
    }
}
