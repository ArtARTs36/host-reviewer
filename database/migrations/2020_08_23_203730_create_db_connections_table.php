<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_connections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('system_id');
            $table->string('host', 40);
            $table->integer('port');
            $table->string('login', 30);
            $table->string('password', 50);

            $table->foreign('system_id')
                ->on('db_systems')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('db_connections');
    }
}
