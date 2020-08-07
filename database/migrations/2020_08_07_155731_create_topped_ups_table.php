<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToppedUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'topped_ups',
            function (Blueprint $table) {
                $table->id();
                $table->integer('amount');
                $table->integer('balance');
                $table->timestamps();
                $table->foreignId("user_id")->references("id")->on("users");
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topped_ups');
    }
}
