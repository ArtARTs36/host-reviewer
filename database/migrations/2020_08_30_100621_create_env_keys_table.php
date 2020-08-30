<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('env_keys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('key');
            $table->unsignedBigInteger('alias_id');
            $table->unsignedBigInteger('project_id');

            $table->foreign('alias_id')
                ->references('id')
                ->on('env_aliases');

            $table->foreign('project_id')
                ->references('id')
                ->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('env_keys');
    }
}
