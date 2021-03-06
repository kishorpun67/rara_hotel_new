<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('tent_type_id');
            $table->string('name');
            $table->string('price');
            $table->string('description');
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
        Schema::dropIfExists('tents');
    }
}
