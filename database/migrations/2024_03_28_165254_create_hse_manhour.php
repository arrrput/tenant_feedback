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
        Schema::create('hse_manhour', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->integer('total_employee');
            $table->integer('work_hour');
            $table->integer('day_work');
            $table->double('ot');
            $table->date('period');
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
        Schema::dropIfExists('hse_manhour');
    }
};
