<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIdToArticlesArtIdInArticleInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ArticleIntervention', function (Blueprint $table) {
            // Renommer la colonne id en ArticlesArtId
            $table->renameColumn('id', 'ArticlesArtId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ArticleIntervention', function (Blueprint $table) {
            // Rétablir le nom original de la colonne si nécessaire
            $table->renameColumn('ArticlesArtId', 'id');
        });
    }
}
