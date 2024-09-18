<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateServiceIdAfterEveryThreeOnesInTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Récupérer toutes les lignes avec service_id = 1 en incluant la colonne 'id'
        $tickets = DB::table('tickets')
            ->where('service_id', 1)
            ->select('id')  // Assurez-vous de sélectionner la colonne 'id'
            ->get();

        $counter = 0;

        // Parcourir chaque ligne et ajouter '2' après trois '1'
        foreach ($tickets as $ticket) {
            $counter++;

            // Si on est à la quatrième ligne, mettre service_id à 2
            if ($counter % 4 == 0) {
                DB::table('tickets')
                    ->where('id', $ticket->id)
                    ->update(['service_id' => 2]);

                // Réinitialiser le compteur pour le groupe suivant
                $counter = 0;
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Optionnel : remettre à null les valeurs de service_id
        DB::table('tickets')->where('service_id', 2)->update(['service_id' => 1]);
    }
}
