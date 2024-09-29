<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropNombreArticlesFromArticleInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Supprimer la colonne nombreArticles de la table ArticleIntervention
        Schema::table('ArticleIntervention', function (Blueprint $table) {
            $table->dropColumn('nombreArticles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Rétablir la colonne nombreArticles dans la table ArticleIntervention
        Schema::table('ArticleIntervention', function (Blueprint $table) {
            $table->integer('nombreArticles')->default(1); // Ajoute la colonne avec valeur par défaut
        });
    }
}
