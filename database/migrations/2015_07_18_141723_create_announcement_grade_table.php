<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementGradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_grade', function(Blueprint $table) {
            $table->integer('announcement_id')->unsigned()->index();
            $table->foreign('announcement_id')
                ->references('id')
                ->on('announcements')
                ->onDelete('cascade');
            $table->integer('grade_id')->unsigned()->index();
            $table->foreign('grade_id')
                ->references('id')
                ->on('grades')
                ->onDelete('cascade');
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
        Schema::drop('announcement_grade');
    }
}
