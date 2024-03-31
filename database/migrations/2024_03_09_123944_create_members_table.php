<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->date('birth_date');
            $table->date('baptism_date')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->date('admission_date')->nullable();
            $table->date('dismissed_date')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
