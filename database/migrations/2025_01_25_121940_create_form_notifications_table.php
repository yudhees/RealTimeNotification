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
        Schema::create('form_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('email',100)->nullable();
            $table->text('message')->nullable();
            $table->string('phone',100)->nullable();
            $table->string('contactMethod',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('fileName',100)->nullable();
            $table->string('dob',20)->nullable();
            $table->boolean('termsAndCondtion')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_notifications');
    }

};
