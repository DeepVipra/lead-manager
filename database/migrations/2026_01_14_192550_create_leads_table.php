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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->date('lead_date')->nullable();
            $table->string('month')->nullable();
            $table->string('client_name')->nullable();
            $table->string('email')->index();
            $table->string('contact_number')->nullable();
            $table->enum('country', ['US', 'Canada', 'UK', 'UAE', 'Others'])->nullable();
            $table->string('service')->nullable();
            $table->string('website')->nullable();
            $table->string('reply')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
