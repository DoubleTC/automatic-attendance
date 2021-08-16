<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomaticAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automatic_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('access_token');
            $table->string('channel_id')->index();
            $table->string('message');
            $table->time('send_at_time');
            $table->boolean('monday')->default(0);
            $table->boolean('tuesday')->default(0);
            $table->boolean('wednesday')->default(0);
            $table->boolean('thursday')->default(0);
            $table->boolean('friday')->default(0);
            $table->boolean('saturday')->default(0);
            $table->boolean('sunday')->default(0);
            $table->timestamp('last_message_send_at')->nullable();
            $table->boolean('last_message_send_status')->default(1);
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
        Schema::dropIfExists('automatic_attendances');
    }
}
