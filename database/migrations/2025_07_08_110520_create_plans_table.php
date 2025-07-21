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

        // Insert default plans
        DB::table('plans')->insert([
            ['name' => 'Starter', 'number_of_qrcodes' => 100,
                'price' => 9, 'price_id' => 'price_1Rkm5KGin0JfRTbQFvITvPWG',
                'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Full Qrcodes', 'number_of_qrcodes' => 500,
                'price' => 18, 'price_id' => 'price_1Rkm8gGin0JfRTbQSeY5usWD',
                'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Super Full Qrcodes', 'number_of_qrcodes' => 1000,
                'price' => 36, 'price_id' => 'price_1Rkm9fGin0JfRTbQeiDmruJo',
                'created_at' => now(), 'updated_at' => now()],
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
