<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('number_of_qrcodes');
            $table->integer('price');
            $table->string('price_id');
            $table->timestamps();
        });

        //insert default plans
        DB::table('plans')->insert([
            [
                'name' => 'Starter','price' => 9, 'number_of_qrcodes' => 100, 
                'price_id' => 'price_1Ro1CHGin0JfRTbQjP2YeufO'
            ],
            [
                'name' => 'Full Qrcodes','price' => 18, 'number_of_qrcodes' => 500, 
                'price_id' => 'price_1Ro1CqGin0JfRTbQW7s2yndr'
            ],
            [
                'name' => 'Super Full Qrcodes','price' => 36, 'number_of_qrcodes' => 1000, 
                'price_id' => 'price_1Ro1DOGin0JfRTbQXttzOKml'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
