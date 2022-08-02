<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->string('nama_event');
                $table->string('slug');
                $table->string('gambar');
                $table->string('alamat');
                $table->text('deskripsi');
                $table->date('acara_mulai');
                $table->date('acara_selesai');
                $table->enum('pendaftaran', ['buka', 'tutup']);
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
        Schema::dropIfExists('events');
    }
}
