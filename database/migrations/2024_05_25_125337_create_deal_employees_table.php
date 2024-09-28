<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_employees', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('deal_id');
            $table->index('employee_id','employee_deal_employee_idx');
            $table->index('deal_id','employee_deal_deal_idx');

            $table->foreign('deal_id','employee_deal_employee_fk')
                ->on('deals')->references('id');
            $table->foreign('employee_id','employee_deal_deal_fk')
                ->on('users')->references('id');

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
        Schema::dropIfExists('deal_employees');
    }
};
