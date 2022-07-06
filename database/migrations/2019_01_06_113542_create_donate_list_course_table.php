<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonateListCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donate_list_course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_name');
            $table->string('originlink');
            $table->string('link');
            $table->string('backuplink')->nullable();
            $table->integer('branch_course_id')->unsigned();
            $table->foreign('branch_course_id')->references('id')->on('branch_course')->onDelete('cascade');
            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('category')->onDelete('cascade');
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
        Schema::dropIfExists('donate_list_course');
    }
}
