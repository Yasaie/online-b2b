<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('path')->nullable();
            $table->enum('type', config('global.place_types'));
            $table->string('name');
            $table->double('latitude', 7, 4)->nullable();
            $table->double('longitude', 7, 4)->nullable();
            $table->boolean('is_visible')->default(1);
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('places')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
