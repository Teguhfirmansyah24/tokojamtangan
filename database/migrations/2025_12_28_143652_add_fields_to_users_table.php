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
            // Role Customer atau Admin
            $table->enum('role', ['customer', 'admin'])->default('customer')->after('password');

            // Foto profile
            $table->string('avatar')->nullable()->after('role');

            // sign-in google OAuth
            $table->string('google_id')->nullable()->unique()->after('avatar');

            // Nomor telepon
            $table->string('phone', 20)->nullable()->after('google_id');

            // Alamat lengkap
            $table->text('address')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColum(['role', 'avatar', 'google_id', 'phone', 'address']);
        });
    }
};
