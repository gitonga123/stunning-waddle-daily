<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopUpNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'top_up_numbers',
            function (Blueprint $table) {
                $table->id();
                $table->string('phone_number');
                $table->string("top_up_time");
                $table->integer('amount');
                $table->boolean('published');
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
        Schema::dropIfExists('top_up_numbers');
    }
}
