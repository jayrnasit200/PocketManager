<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_emi', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->date('date');
            $table->double('amount', 20, 2);
            $table->enum('ststus', ['received', 'not']);
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
        Schema::dropIfExists('books_emi');
    }
};
