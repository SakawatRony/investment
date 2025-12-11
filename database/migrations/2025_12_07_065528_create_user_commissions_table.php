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
        Schema::create('user_commissions', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('to_user_id')->index('users_to_user_id_foreign_idx');
            $table->bigInteger('from_user_id')->index('users_from_user_id_foreign_idx');
            $table->bigInteger('from_refer_user_id')->nullable()->index('users_from_from_refer_user_id_foreign_idx');
            $table->bigInteger('unit_user_id')->nullable()->index('users_to_unit_user_id_foreign_idx');
            $table->decimal('commission', 10, 2);
            $table->boolean('is_invoice')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_commissions');
    }
};
