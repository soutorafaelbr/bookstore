<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksStoresTable extends Migration
{
    public function up()
    {
        Schema::create('book_store', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('store_id')->constrained('stores');
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_store');
    }
}
