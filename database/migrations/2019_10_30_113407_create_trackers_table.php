<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedInteger('user_id')->nullable();
            $table->text('path')->nullable(); # request()->path()
            $table->string('route')->nullable(); # request()->route()->getName()
            $table->text('param1')->nullable(); # json_encode(request()->route()->parameters)
            $table->text('param2')->nullable(); # json_encode(request()->route()->parameters)
            $table->text('param3')->nullable(); # json_encode(request()->route()->parameters)
            $table->string('method')->nullable(); # request()->method()
            $table->string('ip_address')->nullable(); # request()->ip()
            $table->text('agent')->nullable(); # $_SERVER['HTTP_USER_AGENT']
            $table->text('platform')->nullable(); # agent()->platform()
            $table->text('browser')->nullable(); # agent()->browser()
            $table->text('device')->nullable(); # agent()->device()
            $table->text('robot')->nullable(); # agent()->robot()
            $table->double('latitude', 7, 4)->nullable();
            $table->double('longitude', 7, 4)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trackers');
    }
}
