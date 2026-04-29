<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        \DB::statement("ALTER TABLE transactions MODIFY COLUMN type ENUM(
            'recharge',
            'paiement_reservation',
            'paiement_participation',
            'transfert_points',
            'remboursement'
        )");
    }

    public function down(): void
    {
        \DB::statement("ALTER TABLE transactions MODIFY COLUMN type ENUM(
            'recharge',
            'paiement_reservation',
            'transfert_points',
            'remboursement'
        )");
    }
};