<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\PermissionStoreRequest;
use App\Http\Requests\UserRequests\PermissionUpdateRequest;
use App\Models\user\Permission;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{

    public function create(): View|Factory|Application
    {
        return view('permissions.create');
    }

    public function index(): View|Factory|Application
    {
        $permissions = Permission::where('deleted', false)->paginate(10);
        return view('admin.permissions.index', compact('permissions'));
    }

    public function store(PermissionStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        Permission::create($validatedData);
        return response()->json(['message'=> 'Permission created successfully']);
    }

    public function show(Permission $permission): View|Factory|Application
    {
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission): View|Factory|Application
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(PermissionUpdateRequest $request, Permission $permission): JsonResponse
    {
        $validatedData = $request->validated();
        $permission->update($validatedData);
        return response()->json(['message' => 'Permission mise à jour avec succès']);
    }


    public function updateDeleted(int $id): JsonResponse
    {
        $role= Permission::findOrFail($id);
        $role->deleted = true;
        $role->save();
        return response()->json(['message' => 'Permission supprimé avec succès ']);
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }
}
