<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervention_article', function (Blueprint $table) {
            $table->increments('id'); // Clé primaire auto-incrémentée
            $table->unsignedInteger('InterventionsInterventionId'); // Clé étrangère vers la table Interventions
            $table->unsignedInteger('ArtId'); // Clé étrangère vers la table Art
            $table->integer('nombreArticles'); // Nombre d'articles

            // Ajoutez des contraintes de clé étrangère si nécessaire
            $table->foreign('InterventionsInterventionId')->references('InterventionId')->on('Intervention')->onDelete('cascade');
            $table->foreign('ArtId')->references('ArtId')->on('Articles')->onDelete('cascade');

            $table->timestamps(); // Ajoute les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intervention_article');
    }
}
