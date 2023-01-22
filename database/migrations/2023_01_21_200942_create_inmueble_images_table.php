<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmuebleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmueble_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            
            // FK
            $table->unsignedBigInteger('inmueble_id');
            $table->foreign('inmueble_id')->references('id')->on('inmuebles');

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
        Schema::dropIfExists('inmueble_images');
    }
}
