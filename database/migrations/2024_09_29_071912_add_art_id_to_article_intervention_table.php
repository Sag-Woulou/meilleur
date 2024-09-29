<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddArtIdToArticleInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ArticleIntervention', function (Blueprint $table) {
            // Ajouter la colonne ArtId
            $table->unsignedInteger('ArtId')->nullable();

            // Optionnel : définir la clé étrangère si nécessaire
            // $table->foreign('ArtId')->references('ArtId')->on('Articles')->onDelete('no action');
        });

        // Insérer des valeurs aléatoires entre 1 et 100 dans la colonne ArtId
        DB::table('ArticleIntervention')->update([
            'ArtId' => DB::raw('FLOOR(RAND() * 100) + 1')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ArticleIntervention', function (Blueprint $table) {
            // Supprimer la clé étrangère si elle existe
            // $table->dropForeign(['ArtId']);
            // Supprimer la colonne ArtId
            $table->dropColumn('ArtId');
        });
    }
}
