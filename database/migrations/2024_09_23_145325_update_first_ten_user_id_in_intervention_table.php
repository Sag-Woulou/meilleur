<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateFirstTenUserIdInInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Mettez à jour les 10 premières lignes de user_id pour les remplacer par 2
        DB::table('intervention')
            ->whereIn('InterventionId', function ($query) {
                $query->select('InterventionId')
                    ->from('intervention')
                    ->orderBy('InterventionId')
                    ->limit(10);
            })
            ->update(['user_id' => 2]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Ici, vous pouvez gérer la restauration si nécessaire.
        // Cela dépendra de ce que vous souhaitez faire.
    }
}
