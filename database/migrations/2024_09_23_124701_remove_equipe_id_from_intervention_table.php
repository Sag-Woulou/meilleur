<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveEquipeIdFromInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intervention', function (Blueprint $table) {
            $table->dropForeign('FK_intervention_equipe_EquipeId'); // Supprimez la contrainte de clé étrangère
            $table->dropIndex('IX_intervention_EquipeId'); // Supprimez l'index si nécessaire
            $table->dropColumn('EquipeId'); // Supprimez la colonne
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('intervention', function (Blueprint $table) {
            $table->unsignedBigInteger('EquipeId')->nullable(); // Ajoutez des détails selon vos besoins
            $table->foreign('EquipeId')->references('id')->on('equipe'); // Réajoutez la contrainte de clé étrangère si nécessaire
            $table->index('EquipeId', 'IX_intervention_EquipeId'); // Réajoutez l'index si nécessaire
        });
    }
}
