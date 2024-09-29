<div class="modal fade" id="ticketTraiterModalwee5" tabindex="-1" role="dialog" aria-labelledby="interventionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInterventionModalLabel">Ajouter une Intervention</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addInterventionForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombreArticles">Articles et Quantité</label>
                        <div id="articlesContainer">
                            <!-- Article initial -->
                            <div class="d-flex align-items-center mb-2">
                                <select name="articles[0][ArtId]" class="form-control select-article" required>
                                    <option value="">Sélectionnez un article</option>
                                    @foreach($articles as $article)
                                        <option value="{{ $article->ArtId }}">{{ $article->ArtLibelle }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="articles[0][quantity]" class="form-control ml-2" placeholder="Quantité" min="1" required style="width: 100px;">
                                <button type="button" class="btn btn-danger btn-sm ml-2 remove-article">Supprimer</button>
                            </div>
                        </div>
                        <button type="button" id="addArticleButton" class="btn btn-secondary btn-sm">Ajouter un Article</button>
                        <span id="error-articles" class="text-danger"></span>
                    </div>

                    <!-- Autres champs -->
                    <div class="form-group">
                        <label for="typePanne">Type de Panne</label>
                        <select id="typePanne" name="PanneReelsTypePanneId" class="form-control" required>
                            <option value="">Sélectionnez un type de panne</option>
                            @foreach($typePannes as $typePanne)
                                <option value="{{ $typePanne->TypePanneId }}">{{ $typePanne->TypePanne }}</option>
                            @endforeach
                        </select>
                        <span id="error-typePanne" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="Description">Commentaire</label>
                        <textarea id="Description" name="Description" class="form-control" placeholder="Ajoutez un commentaire..." required></textarea>
                        <span id="error-Description" class="text-danger"></span>
                    </div>

                    <input type="hidden" id="TicketId" name="TicketId" value="">
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                </div>

                <div class="modal-footer">
                    <button id="traiterButton3" type="submit" class="btn btn-primary">Attente de réaction</button>
                    <button id="traiterButton4" type="submit" class="btn btn-primary">Terminer</button>
                    <button type="button" id="dismissButton" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let articleIndex = 1;

    document.getElementById('addArticleButton').addEventListener('click', function() {
        const container = document.getElementById('articlesContainer');

        const newArticle = `
        <div class="d-flex align-items-center mb-2">
            <select name="articles[${articleIndex}][ArtId]" class="form-control select-article" required>
                <option value="">Sélectionnez un article</option>
                @foreach($articles as $article)
        <option value="{{ $article->ArtId }}">{{ $article->ArtLibelle }}</option>
                @endforeach
        </select>
        <input type="number" name="articles[${articleIndex}][quantity]" class="form-control ml-2" placeholder="Quantité" min="1" required style="width: 100px;">
            <button type="button" class="btn btn-danger btn-sm ml-2 remove-article">Supprimer</button>
        </div>
    `;

        container.insertAdjacentHTML('beforeend', newArticle);
        articleIndex++;
    });

    // Supprimer un article
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('remove-article')) {
            event.target.closest('.d-flex').remove();
        }
    });

    // Récupérer les articles sélectionnés et leurs quantités
    document.getElementById('addInterventionForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire pour le test

        const selectedArticles = [];
        const articleSelects = document.querySelectorAll('select[name^="articles"]');
        const quantityInputs = document.querySelectorAll('input[name^="articles"][name$="[quantity]"]');

        for (let i = 0; i < articleSelects.length; i++) {
            const articleId = articleSelects[i].value;
            const quantity = quantityInputs[i].value;

            if (articleId && quantity) {
                selectedArticles.push({
                    articleId: articleId,
                    quantity: quantity
                });
            }
        }

        console.log(selectedArticles); // Affiche les articles sélectionnés avec les quantités
        // Vous pouvez ensuite envoyer ces données au serveur
    });

</script>


