<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromosiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('promosi', function (Blueprint $table) {
        //     $table->uuid('id')->primary();
        //     $table->string('judul');
        //     $table->string('slug');
        //     $table->text('deskripsi');
        //     $table->string('image');
        //     $table->date('tgl_mulai');
        //     $table->date('tgl_akhir');
        //     $table->kupon_id('kupon_id');

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promosi');
    }
}
