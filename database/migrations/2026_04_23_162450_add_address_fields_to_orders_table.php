<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('user_id');
            $table->string('phone')->nullable()->after('full_name');
            $table->string('street_address')->nullable()->after('shipping_address');
            $table->string('city')->nullable()->after('street_address');
            $table->string('state')->nullable()->after('city');
            $table->string('zip_code')->nullable()->after('state');
            $table->string('address_type')->default('home')->after('zip_code');
            $table->text('delivery_instructions')->nullable()->after('address_type');
            $table->decimal('latitude', 10, 8)->nullable()->after('delivery_instructions');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'full_name', 
                'phone', 
                'street_address', 
                'city', 
                'state', 
                'zip_code', 
                'address_type',
                'delivery_instructions',
                'latitude', 
                'longitude'
            ]);
        });
    }
};