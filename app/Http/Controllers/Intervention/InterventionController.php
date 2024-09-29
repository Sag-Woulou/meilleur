<?php

namespace App\Http\Controllers\intervention;

use App\Http\Controllers\Controller;
use App\Http\Requests\InterventionStoreRequest;
use App\Models\intervention\InterventionStatut;
use App\Models\intervention\InterventionArticle;
use Illuminate\Http\Request;
use App\Models\intervention\Article;
use App\Models\intervention\Intervention;
use App\Models\intervention\TypePanneReel;

class InterventionController extends Controller
{
    // Fonction pour afficher le formulaire
    public function create()
    {
        // Récupérer les articles et les types de panne pour les envoyer à la vue
        $articles = Article::all();
        $typePannes = TypePanneReel::all();
        $statuts = InterventionStatut::all();

        // Vue à compléter avec le chemin correct
        return view('interventions.create', compact('articles', 'typePannes', 'statuts'));
    }

    public function store(InterventionStoreRequest $request)
    {
        // Les données sont déjà validées ici
        $validatedData = $request->validated();

        $intervention = Intervention::create([
            'TicketId' => $validatedData['TicketId'],
            'user_id' => $validatedData['user_id'],
            'PanneReelsTypePanneId' => $validatedData['PanneReelsTypePanneId'],
            'Description' => $validatedData['Description'],
            'InterventionStatutId' => $validatedData['InterventionStatutId'], // Inclure InterventionStatutId ici
        ]);

        // Ajouter les articles associés
        foreach ($validatedData['articles'] as $articleData) {
            InterventionArticle::create([
                'InterventionsInterventionId' => $intervention->InterventionId,
                'ArtId' => $articleData['ArtId'],
                'nombreArticles' => $articleData['quantity'],
            ]);
        }

        return response()->json(['message' => 'Intervention ajoutée avec succès'], 201);
    }
}
