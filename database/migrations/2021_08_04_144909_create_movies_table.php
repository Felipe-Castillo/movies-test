<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->date('publication_date')->nullable();
            $table->enum('status', ['active', 'inactive']);

            $table->unsignedBigInteger('genre_id');

            $table->foreign('genre_id')->references('id')->on('genres')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
