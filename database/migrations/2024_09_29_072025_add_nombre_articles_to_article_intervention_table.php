<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddNombreArticlesToArticleInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ArticleIntervention', function (Blueprint $table) {
            // Ajouter la colonne nombreArticles
            $table->unsignedInteger('nombreArticles')->default(1); // Valeur par défaut de 1
        });

        // Insérer des valeurs aléatoires entre 1 et 5 dans la colonne nombreArticles
        DB::table('ArticleIntervention')->update([
            'nombreArticles' => DB::raw('FLOOR(RAND() * 5) + 1')
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
            // Supprimer la colonne nombreArticles
            $table->dropColumn('nombreArticles');
        });
    }
}
