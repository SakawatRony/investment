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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('user_id')->nullable()->index('users_user_id_foreign_idx')->nullable();
            $table->decimal('price', 10, 2)->nullable()->nullable();
            $table->bigInteger('unit_user_id')->nullable()->index('units_unit_user_id_foreign_idx')->nullable();
            $table->decimal('commission', 10, 2)->nullable();
            $table->text('params')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_withdraw')->default(0);
            $table->boolean('withdraw_approve')->default(0);
            $table->boolean('withdraw_reject')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
