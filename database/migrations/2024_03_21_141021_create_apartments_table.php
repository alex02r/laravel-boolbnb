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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('city');
            $table->string('zip_code');
            $table->string('address');
            $table->integer('rooms');
            $table->integer('bathrooms');
            $table->integer('beds');
            $table->integer('square_meters');
            $table->decimal('lat', 10, 7);
            $table->decimal('lon', 10, 7);
            $table->string('cover_img');
            $table->boolean('show');
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
        Schema::dropIfExists('apartments');
    }
};