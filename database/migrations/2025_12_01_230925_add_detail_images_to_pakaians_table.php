<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pakaians', function (Blueprint $table) {
            $table->string('image_collar')->nullable();
            $table->string('image_material')->nullable();
            $table->string('image_back')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pakaians', function (Blueprint $table) {
            $table->dropColumn(['image_collar', 'image_material', 'image_back']);
        });
    }

};
