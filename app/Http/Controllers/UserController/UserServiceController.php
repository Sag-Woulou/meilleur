<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\UserServiceStoreRequest;
use App\Models\ServiceUser;
use App\Models\user\Service;
use App\Models\user\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;

class UserServiceController extends Controller
{
    public function index(): View|Factory|Application
    {
        $users = User::with('services')->has('services')->get();
        $services = Service::whereNull('deleted_at')->get();
        $allUsers = User::where('deleted', 0)->get();

        return view('admin.userservice.index', compact('users', 'services', 'allUsers'));
    }
    public function create(): View|Factory|Application
    {
        return view('userService.create');
    }
    public function store(UserServiceStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $userId = $validatedData['user_id'];
        $serviceIds = $validatedData['service_id'];

        if (is_array($serviceIds)) {
            foreach ($serviceIds as $serviceId) {
                ServiceUser::updateOrCreate(
                    ['user_id' => $userId, 'service_id' => $serviceId],
                    ['updated_at' => now(), 'created_at' => now()]
                );
            }
        } else {
            ServiceUser::updateOrCreate(
                ['user_id' => $userId, 'service_id' => $serviceIds],
                ['updated_at' => now(), 'created_at' => now()]
            );
        }

        return response()->json(['message' => 'Services associés à l\'utilisateur avec succès.'], 201);
    }
    public function show(int $id): JsonResponse
    {
        $user = User::with('services')->findOrFail($id);

        return response()->json([
            'user' => $user,
        ]);
    }
    public function update(UserServiceStoreRequest $request, $userId): JsonResponse
    {
        $validatedData = $request->validated();
        $serviceIds = $validatedData['service_id'];

        if (!is_array($serviceIds)) {
            return response()->json(['error' => 'Invalid services data.'], 400);
        }

        ServiceUser::where('user_id', $userId)->delete();
        foreach ($serviceIds as $serviceId) {
            ServiceUser::updateOrCreate(
                ['user_id' => $userId, 'service_id' => $serviceId],
                ['updated_at' => now(), 'created_at' => now()]
            );
        }
        return response()->json(['message' => 'Services mis à jour avec succès.'], 200);
    }
    public function destroy(User $user): JsonResponse
    {
        $deleted = ServiceUser::where('user_id', $user->id)->delete();

        if ($deleted) {
            return response()->json(['message' => 'Relation supprimée avec succès.'], 200);
        } else {
            return response()->json(['error' => 'Relation non trouvée.'], 404);
        }
    }
}
