<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddPanneReelsTypePanneIdToInterventionTable extends Migration
{
    public function up()
    {
        Schema::table('intervention', function (Blueprint $table) {
            // Ajoutez la colonne PanneReelsTypePanneId avec le bon type
            $table->unsignedInteger('PanneReelsTypePanneId')->nullable();

            // Ajoutez la contrainte de clé étrangère sans cascade
            $table->foreign('PanneReelsTypePanneId')
                ->references('TypePanneId')
                ->on('typePanneReel')
                ->onDelete('no action'); // Modification ici
        });

        // Remplissez la colonne avec des valeurs aléatoires entre 1 et 88
        $interventions = DB::table('intervention')->get();
        foreach ($interventions as $intervention) {
            DB::table('intervention')->where('InterventionId', $intervention->InterventionId)
                ->update(['PanneReelsTypePanneId' => rand(1, 88)]);
        }
    }

    public function down()
    {
        Schema::table('intervention', function (Blueprint $table) {
            // Supprimez la contrainte de clé étrangère
            $table->dropForeign(['PanneReelsTypePanneId']);
            // Supprimez la colonne
            $table->dropColumn('PanneReelsTypePanneId');
        });
    }
}
