<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServiceReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_revenues', function (Blueprint $table) {
            $table->string("department");
            $table->integer("wip")->default(0);
            $table->decimal("hours_sold",15,2);
            $table->decimal("sales",15,4);
            $table->string("analysis_code");
            $table->string("operator_code");
            $table->integer("invoice")->default(0);
            $table->integer("customer_id")->default(0);
            $table->integer("magic_no")->primary();
            $table->date("date_edited");
            $table->string("registration",20);
            $table->foreignId("company_code")->nullable();

            $table->foreign('company_code')->references('id')
                ->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshop_revenues');
    }
}
