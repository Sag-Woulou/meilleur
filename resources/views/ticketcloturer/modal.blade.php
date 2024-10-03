<div class="modal fade" id="ticketDetailsModalwee12" tabindex="-1" role="dialog" aria-labelledby="ticketDetailsModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketDetailsModalLabel1">Détails du Ticket</h5>
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
                                <p><strong>ID du Ticket:</strong> <span id="ticketId1"></span></p>
                                <p><strong>Description:</strong> <span id="ticketDescription1"></span></p>
                                <p><strong>Date de Création:</strong> <span id="ticketCreationDatetime1"></span></p>
                                <p><strong>Numéro Appelant:</strong> <span id="ticketNumeroAppelant1"></span></p>
                                <p><strong>Rue:</strong> <span id="ticketRue1"></span></p>
                                <p><strong>Quartier:</strong> <span id="ticketQuartier1"></span></p>
                                <p><strong>Indication Précise:</strong> <span id="ticketIndicationPrecise1"></span></p>
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
                                <p><strong>Nom:</strong> <span id="abonneNom1"></span></p>
                                <p><strong>Prénom:</strong> <span id="abonnePrenom1"></span></p>
                                <p><strong>Police:</strong> <span id="abonnePolice1"></span></p>
                                <p><strong>Clé:</strong> <span id="abonneCle1"></span></p>
                                <p><strong>Numéro de Compteur:</strong> <span id="abonneNumeroCompteur1"></span></p>
                                <p><strong>Type de Compteur:</strong> <span id="abonneTypeCompteur1"></span></p>
                                <p><strong>État Client:</strong> <span id="abonneEtatClient1"></span></p>
                                <p><strong>Date de l'État:</strong> <span id="abonneDateEtat1"></span></p>
                                <p><strong>Quartier de l'Abonné:</strong> <span id="abonneQuartier1"></span></p>
                                <p><strong>Téléphone:</strong> <span id="abonneTel1"></span></p>
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
                            <div class="accordion-body" id="commentaireDetails1">
                                <!-- Les commentaires seront chargés ici par AJAX -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="dismissButtoncloturer" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
