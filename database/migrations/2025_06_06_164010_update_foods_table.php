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
        Schema::table('foods', function (Blueprint $table) {
            $table->float('calories')->nullable();     // Калорийность (ккал)
            $table->float('protein')->nullable();      // Белки (г)
            $table->float('fat')->nullable();          // Жиры (г)
            $table->float('carbohydrates')->nullable(); // Углеводы (г)
            $table->float('fiber')->nullable();        // Клетчатка (г)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'calories',
                'protein',
                'fat',
                'carbohydrates',
                'fiber',
            ]);
        });
    }
};
