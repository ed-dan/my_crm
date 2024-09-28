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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("task_id")->nullable();
            $table->unsignedBigInteger("stage_id");
            $table->unsignedBigInteger("note_id")->nullable();
            $table->unsignedBigInteger("employee_id");
            $table->unsignedBigInteger("lead_id");
            $table->unsignedBigInteger("amount");
            $table->string("city")->nullable();
            $table->string("address")->nullable();
            $table->string("products");
            $table->unsignedBigInteger("status_id");
            $table->dateTime("closing_date");
            $table->index('note_id','note_deal_idx');
            $table->index('task_id','deal_task_idx');
            $table->index('status_id','deal_status_idx');
            $table->timestamps();
        });

        Schema::table('deals', function (Blueprint $table) {
            $table->foreign('employee_id', 'deal_employee_fk')
                ->references('id')
                ->on('users');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('deal_id', 'deal_task_fk')
                ->references('task_id')
                ->on('deals');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
};
