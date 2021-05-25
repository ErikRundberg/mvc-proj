<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistogramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histograms', function(Blueprint $table) {
            $table->id();
            $table->integer('one')->nullable()->default(0);
            $table->integer('two')->nullable()->default(0);
            $table->integer('three')->nullable()->default(0);
            $table->integer('four')->nullable()->default(0);
            $table->integer('five')->nullable()->default(0);
            $table->integer('six')->nullable()->default(0);
            $table->timestamps();
        });

        DB::table('histograms')->insert([
            'one' => 0
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histograms');
    }
}
