<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('est_building', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('building');
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('est_file_building', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_building');
            $table->string('drawing_type');
            $table->string('file_name');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('est_building');
    }
};
