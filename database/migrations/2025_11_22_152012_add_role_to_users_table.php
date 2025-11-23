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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'rider'])->default('admin')->after('email');
            $table->string('phone')->nullable()->after('role');
            $table->string('vehicle_type')->nullable()->after('phone');
            $table->enum('status', ['active', 'inactive', 'on_delivery'])->default('active')->after('vehicle_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'vehicle_type', 'status']);
        });
    }
};
