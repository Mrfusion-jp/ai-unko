<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelexportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excelexport', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('ItemName', 150)->nullable();
			$table->string('ItemCode', 150)->nullable();
			$table->date('Date')->nullable();
			$table->integer('Price')->nullable();
			$table->integer('Quantity')->nullable();
			$table->text('description')->nullable();
			$table->string('image', 255)->nullable();
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
        Schema::dropIfExists('excelexport');
    }
}
