<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source_id');
            //$table->string('lead_name');
            //$table->string('lead_details');
            $table->string('email');
            $table->string('contact_number_1');
            $table->string('feedback')->nullable();
            $table->enum('status', ['1', '2', '3'])->comment('1 Pending, 2 Failed, 3 Closed')->default(1);
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
        Schema::dropIfExists('leads');
    }
}
