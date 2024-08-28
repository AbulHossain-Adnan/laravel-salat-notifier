<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalatTimesTable extends Migration
{
    public function up()
    {
        Schema::create('salat_times', function (Blueprint $table) {
            $table->id();
            $table->string('salat')->unique();
            $table->time('time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salat_times');
    }
}
