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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('payment_method')->default('dummy_payment');
            $table->timestamp('transaction_date')->useCurrent();
            $table->string('status')->default('pending')->change();
            $table->decimal('amount', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->dropColumn('transaction_date');
            $table->string('status')->change();
            $table->decimal('amount', 8, 2)->change();
        });
    }
};
