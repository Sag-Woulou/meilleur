<div class="modal fade" id="ticketDetailsModalwee" tabindex="-1" role="dialog" aria-labelledby="ticketDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketDetailsModalLabel">Détails du Ticket</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Informations du ticket #1
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p><strong>ID du Ticket:</strong> <span id="ticketId"></span></p>
                                <p><strong>Description:</strong> <span id="ticketDescription"></span></p>
                                <p><strong>Date de Création:</strong> <span id="ticketCreationDatetime"></span></p>
                                <p><strong>Numéro Appelant:</strong> <span id="ticketNumeroAppelant"></span></p>
                                <p><strong>Rue:</strong> <span id="ticketRue"></span></p>
                                <p><strong>Quartier:</strong> <span id="ticketQuartier"></span></p>
                                <p><strong>Indication Précise:</strong> <span id="ticketIndicationPrecise"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Informations de l'Abonné #2
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p><strong>Nom:</strong> <span id="abonneNom"></span></p>
                                <p><strong>Prénom:</strong> <span id="abonnePrenom"></span></p>
                                <p><strong>Police:</strong> <span id="abonnePolice"></span></p>
                                <p><strong>Clé:</strong> <span id="abonneCle"></span></p>
                                <p><strong>Numéro de Compteur:</strong> <span id="abonneNumeroCompteur"></span></p>
                                <p><strong>Type de Compteur:</strong> <span id="abonneTypeCompteur"></span></p>
                                <p><strong>État Client:</strong> <span id="abonneEtatClient"></span></p>
                                <p><strong>Date de l'État:</strong> <span id="abonneDateEtat"></span></p>
                                <p><strong>Quartier de l'Abonné:</strong> <span id="abonneQuartier"></span></p>
                                <p><strong>Téléphone:</strong> <span id="abonneTel"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Commentaire lié au ticket #3
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body" id="commentaireDetails">
                                <!-- Les commentaires seront chargés ici par AJAX -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="traiterButton2" type="submit" class="btn btn-primary" data-id="{{ $ticket->id }}">Traiter</button>
                <button type="button" id="dismissButton" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ticketTraiterModalwee" tabindex="-1" role="dialog" aria-labelledby="ticketDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketDetailsModalLabel">Détails du Ticket</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Informations du ticket #1
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Informations de l'Abonné #2
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Commentaire lié au ticket #3
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="traiterButton2" type="submit" class="btn btn-primary">Enregistrer</button>
                <button type="button" id="dismissButton" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

