<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdToCentreDistribTable extends Migration
{
    public function up()
    {
        Schema::table('Centre_distrib', function (Blueprint $table) {
            // Étape 1 : Ajouter la colonne 'id' comme auto-incrémentée
            $table->bigIncrements('id');
        });
    }

    public function down()
    {
        Schema::table('Centre_distrib', function (Blueprint $table) {
            // Étape pour annuler la migration
            $table->dropColumn('id');
        });
    }
}
