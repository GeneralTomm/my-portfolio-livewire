<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalPdfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_pdf', function (Blueprint $table) {
            $table->id();
            $table->string('judul_jurnal');
            $table->text('abstract');
            $table->string('keyword');
            $table->string('lisensi');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('file_jurnal')->nullable();
            $table->string('berkontribusi');
            $table->deleted_at();
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
        Schema::dropIfExists('journal_pdfs');
    }
}
