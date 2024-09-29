<?php

namespace App\Http\Controllers\intervention;

use App\Http\Controllers\Controller;
use App\Http\Requests\InterventionStoreRequest;
use App\Models\intervention\InterventionStatut;
use App\Models\intervention\InterventionArticle;
use App\Models\intervention\Article;
use App\Models\intervention\Intervention;
use App\Models\intervention\TypePanneReel;

use App\Models\ticket\CommentaireTicket;
use App\Models\ticket\StatutTicket;
use Illuminate\Http\JsonResponse;

class InterventionController extends Controller
{
    public function create()
    {
        $articles = Article::all();
        $typePannes = TypePanneReel::all();
        $statuts = InterventionStatut::all();
        return view('interventions.create', compact('articles', 'typePannes', 'statuts'));
    }
    public function store(InterventionStoreRequest $request):JsonResponse
    {
        $validatedData = $request->validated();
        $InterventionStatutId = $validatedData['InterventionStatutId'];
        $intervention = Intervention::create([
            'TicketId' => $validatedData['TicketId'],
            'user_id' => $validatedData['user_id'],
            'PanneReelsTypePanneId' => $validatedData['PanneReelsTypePanneId'],
            'Description' => $validatedData['Description'],
            'InterventionStatutId' => $validatedData['InterventionStatutId'],
        ]);

        foreach ($validatedData['articles'] as $articleData) {
            InterventionArticle::create([
                'InterventionsInterventionId' => $intervention->InterventionId,
                'ArtId' => $articleData['ArtId'],
                'nombreArticles' => $articleData['quantity'],
            ]);
        }
        if($InterventionStatutId == 2 || $InterventionStatutId == 3) {
            if($InterventionStatutId == 2) {
                $statusID = 4;
            }
            if($InterventionStatutId == 3) {
                $statusID = 6;
            }
            $status = StatutTicket::findOrFail($statusID);
            if($status) {
                $commentaire = CommentaireTicket::where('TicketId', $validatedData['TicketId'])
                    ->orderBy('CommentaireTicketId', 'desc')
                    ->first();
                if ($commentaire) {
                    $commentaire->StatutTicketId = $status->StatutTicketId;
                    $commentaire->save();
                }
            } else {
                return response()->json(['error' => 'Statut non trouvé'], 404);
            }
    }
        return response()->json(['message' => 'Intervention ajoutée avec succès'], 201);
    }
}
