<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_category_id')
                ->constrained('financial_categories')
                ->onDelete('restrict');
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('restrict');
            $table->string('type');
            $table->decimal('amount', 10, 2);
            $table->date('action_date');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->index(['action_date', 'financial_category_id']);
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
