<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PartsReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts_revenue', function (Blueprint $table) {
            $table->decimal("retail",15,5)->nullable();
            $table->decimal("net_sale",15,5)->nullable();
            $table->integer("discount")->nullable();
            $table->decimal("sales_cost",15,5)->nullable();
            $table->decimal("gross_profit",15,5)->nullable();
            $table->decimal("gross_percentage",15,8)->nullable();
            $table->date("posting_date")->nullable()->nullable();
            $table->integer("wip")->nullable();
            $table->integer("invoice")->nullable();
            $table->string("department",20)->nullable();
            $table->string("franchise",20)->nullable();
            $table->integer("account")->nullable();
            $table->text("customer")->nullable();
            $table->integer("quantity")->nullable();
            $table->string("part_number",255)->nullable();
            $table->char("analysis_code")->nullable();
            $table->string("discount1",20)->nullable();
            $table->string("discount2",20)->nullable();
            $table->integer("magic")->primary();

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
        Schema::dropIfExists('parts_revenue');
    }
}
