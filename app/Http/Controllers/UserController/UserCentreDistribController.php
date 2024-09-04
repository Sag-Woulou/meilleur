<?php

namespace App\Http\Controllers\UserController;

use App\Http\Requests\UserRequests\UserCentreDistribUpdateRequest;
use App\Models\user\User;
use App\Models\user\CentreDistrib;
use App\Models\UserCentreDistrib;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCentreDistribController extends Controller
{
    /**
     * Afficher la liste des utilisateurs avec leurs centres de distribution.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View|Factory|Application
    {
        $centreDistribs = CentreDistrib::all();
        $allUsers = User::where('deleted', 0)->get();
        $userCentreDistribs = User::where('deleted', 0)->with('centreDistribs')->has('centreDistribs')->get();
        return view('admin.usercentre.index', compact('userCentreDistribs', 'centreDistribs', 'allUsers'));
    }

    /**
     * Afficher le formulaire de création.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View|Factory|Application
    {
        return view('usercentre.create');
    }

    /**
     * Enregistrer une nouvelle association entre un utilisateur et des centres de distribution.
     *
     * @param UserCentreDistribUpdateRequest $request
     * @return JsonResponse
     */
    public function store(UserCentreDistribUpdateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $userId = $validatedData['user_id'];
        $centreDistribIds = $validatedData['centre_distrib_ids']; // Utiliser centre_distrib_ids

        // Récupérer l'utilisateur par son ID
        $user = User::findOrFail($userId);

        // Synchroniser les centres de distribution associés à l'utilisateur
        $user->centreDistribs()->sync($centreDistribIds);

        return response()->json(['message' => 'Centres de distribution associés à l\'utilisateur avec succès.'], 201);
    }

    /**
     * Afficher un utilisateur spécifique avec ses centres de distribution.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        // Charger l'utilisateur avec ses centres de distribution associés
        $user = User::with('centreDistribs')->findOrFail($id);

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Mettre à jour les centres de distribution associés à un utilisateur existant.
     *
     * @param UserCentreDistribUpdateRequest $request
     * @param int $userId
     * @return JsonResponse
     */
    public function update(UserCentreDistribUpdateRequest $request, int $userId): JsonResponse
    {
        $validatedData = $request->validated();
        $centreDistribIds = $validatedData['centre_distrib_ids']; // Utiliser centre_distrib_ids

        if (!is_array($centreDistribIds)) {
            return response()->json(['error' => 'Les données de centres de distribution sont invalides.'], 400);
        }

        // Récupérer l'utilisateur par son ID
        $user = User::findOrFail($userId);

        // Synchroniser les centres de distribution associés à l'utilisateur
        $user->centreDistribs()->sync($centreDistribIds);

        return response()->json(['message' => 'Centres de distribution mis à jour avec succès.'], 200);
    }

    /**
     * Supprimer la relation entre un utilisateur et tous ses centres de distribution.
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function destroy(int $userId): JsonResponse
    {
        // Récupérer l'utilisateur par son ID
        $user = User::findOrFail($userId);

        // Détacher tous les centres de distribution associés
        $user->centreDistribs()->detach();

        return response()->json(['message' => 'Relations supprimées avec succès.'], 200);
    }
}
