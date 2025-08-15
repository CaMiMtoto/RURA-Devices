<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('confirmed_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Asset::class)->constrained();
            $table->foreignIdFor(\App\Models\User::class, 'confirmed_by')->constrained();
            $table->string('status')->default('confirmed');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmed_assets');
    }
};
