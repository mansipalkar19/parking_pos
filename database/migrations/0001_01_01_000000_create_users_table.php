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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('mobile', 15)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('username', 50)->unique();
            $table->string('password', 255);

            $table->enum('role', ['admin', 'vendor', 'owner', 'customer'])
                ->default('customer');

            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('place_id')->nullable();

            $table->tinyInteger('status')->default(1);

            $table->string('api_token', 100)->nullable();

            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // admin, vendor, owner, customer
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });

        Schema::create('places', function (Blueprint $table) {
            $table->id(); // id (PK, AUTO)
            $table->string('place_name', 150);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('country', 100);
            $table->tinyInteger('status')->default(0); // 0=Active, 1=Inactive
            $table->timestamps(); // created_at, updated_at
        });

        Schema::create('vehicle_type', function (Blueprint $table) {
            $table->id(); // id (PK, AUTO)
            $table->string('vehicle_type_name', 100);
            $table->tinyInteger('status')->default(0); // 0=Active, 1=Inactive
            $table->timestamps(); // created_at, updated_at
        });

        Schema::create('parking_rates', function (Blueprint $table) {
            $table->id(); // id (PK, AUTO)
            $table->string('parking_lot_id', 100);
            $table->string('vehicle_type_id', 100);
            $table->string('hourly_rate', 100);
            $table->string('daily_rate', 100);
            $table->tinyInteger('status')->default(0); // 0=Active, 1=Inactive
            $table->timestamps(); // created_at, updatparking_lot_ided_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
