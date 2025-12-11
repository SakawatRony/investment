<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_commissions', function (Blueprint $table) {
            $table->foreign(['to_user_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['from_user_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['from_refer_user_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['unit_user_id'])->references(['id'])->on('unit_users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_commissions', function (Blueprint $table) {
            $table->dropForeign('users_to_user_id_foreign_idx');
            $table->dropForeign('users_from_user_id_foreign_idx');
            $table->dropForeign('users_from_from_refer_user_id_foreign_idx');
            $table->dropForeign('users_to_unit_user_id_foreign_idx');
        });
    }
};
