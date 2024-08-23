<?php

namespace App\Http\Controllers\UserController;

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
        $permissions = Permission::all();

        return view('admin.rolelier.index', compact('roles', 'permissions'));
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
    public function store(Request $request): JsonResponse
    {
        $role = Role::findOrFail($request->role);
        $role->permissions()->sync($request->permissions);

        return response()->json([
            'message' => 'Permissions associées au rôle avec succès.',
            'role' => $role->load('permissions'),
        ], 201);
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
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->permissions);

        return response()->json([
            'message' => 'Permissions mises à jour avec succès.',
            'role' => $role->load('permissions'),
        ]);
    }


    /**
     * Supprimer un rôle et dissocier toutes ses permissions.
     *
     * @param int $roleId
     * @return JsonResponse
     */
    public function destroy(int $roleId): JsonResponse
    {
        $role = Role::findOrFail($roleId);
        $role->permissions()->detach();
        $role->delete();

        return response()->json([
            'message' => 'Rôle et permissions supprimés avec succès.',
        ]);

    }
}
