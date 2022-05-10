<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSophicFieldsToLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('user_id');
            $table->string('prospect_first_name')->nullable()->after('company_name');
            $table->string('prospect_last_name')->nullable()->after('prospect_first_name');
            $table->string('job_title')->nullable()->after('prospect_last_name');
            $table->string('employee_size')->nullable()->after('job_title');
            $table->string('web_address')->nullable()->after('employee_size');
            $table->string('revenue_size')->nullable()->after('web_address');
            $table->string('company_industry')->nullable()->after('revenue_size');
            $table->string('physical_address')->nullable()->after('company_industry');
            $table->string('city')->nullable()->after('physical_address');
            $table->string('state')->nullable()->after('city');
            $table->string('zip_code')->nullable()->after('state');
            $table->string('country')->nullable()->after('zip_code');
            $table->string('linkedin_address')->nullable()->after('country');
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            //
        });
    }
}
