<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\ServiceStoreRequest;
use App\Http\Requests\UserRequests\ServiceUpdateRequest;
use App\Models\user\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): View|Factory|Application
    {
        $services = Service::paginate(10);
        return view('admin.service.index', compact('services'));
    }

    public function create(): View|Factory|Application
    {
        return view('services.create');
    }

    public function store(ServiceStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        Service::create($validatedData);
        return response()->json(['message' => 'Service crée avec succès']);
    }

    public function update(ServiceUpdateRequest $request, Service $service): JsonResponse
    {
        $validatedData = $request->validated();
        $service->update($validatedData);
        return response()->json(['message' => 'Service mis à jour avec succès']);
    }


    public function edit(Service $service): View|Factory|Application
    {
        return view('services.edit', compact('service'));
    }



    public function destroy( Service $service): JsonResponse
    {
        $service->delete();
        return response()->json(['message' => 'success', 'Service deleted successfully']);
    }



}
