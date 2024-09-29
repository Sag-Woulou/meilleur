<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameArticlesArtIdInArticleInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ArticleIntervention', function (Blueprint $table) {
            // Renommer la colonne ArticlesArtId en id
            $table->renameColumn('ArticlesArtId', 'id');
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
            $table->renameColumn('id', 'ArticlesArtId');
        });
    }
}
