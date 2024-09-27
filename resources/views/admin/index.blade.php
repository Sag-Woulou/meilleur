@extends('adminbase.dashboard')

@section('tableview')
    <div class="main-content">
        <div class="container-fluid">
            <!-- En-tête avec slogan et image -->
            <div class="row mb-4">
                <div class="col-md-12 d-flex align-items-center justify-content-between" style="background: linear-gradient(to right, #257891, #47107c, #2c3e50); padding: 20px; border-radius: 10px;">
                    <div>
                        <h1 class="text-white">Gestion des Doléances - SONABEL</h1>
                        <h4 class="text-white">"L'énergie qui alimente vos ambitions"</h4>
                        <p class="text-white">Surveillez et gérez efficacement les doléances des clients pour assurer une réponse rapide et adaptée aux besoins de la population.</p>
                    </div>
                    <div>
                        <!-- Ajout de l'image -->
                        <img src="{{ asset('img/img.png') }}" alt="Technicien SONABEL" class="img-fluid" style="max-height: 200px; border-radius: 10px;">
                    </div>
                </div>
            </div>

            <!-- Section Mot de motivation -->
            <div class="row">
                <div class="col-md-12">
                    <div style="padding: 20px; background-color: #f4f4f9; border-radius: 10px;">
                        <h2 class="text-primary">Notre engagement envers nos clients</h2>
                        <p>
                            Chez SONABEL, nous croyons en la fourniture d'un service électrique de qualité, fiable et durable.
                            La gestion des doléances de nos clients est une priorité, car elle nous permet de maintenir un réseau
                            stable et d'améliorer la satisfaction de nos usagers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
