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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('phone_number')->nullable();
            $table->foreignIdFor(\App\Models\Department::class)->nullable()->constrained();
            $table->boolean('is_super_admin')->default(false);
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('phone_number');
            $table->dropConstrainedForeignIdFor(\App\Models\Department::class);
            $table->dropColumn('is_super_admin');
            $table->dropColumn('is_active');
        });
    }
};
