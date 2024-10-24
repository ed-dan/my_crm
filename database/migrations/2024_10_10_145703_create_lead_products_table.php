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
        Schema::create('lead_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('quantity')->nullable();
            $table->index('lead_id','lead_product_lead_idx');
            $table->index('product_id','lead_product_product_idx');

            $table->foreign('lead_id','lead_product_lead_fk')
                ->on('leads')->references('id');
            $table->foreign('product_id','lead_product_product_fk')
                ->on('products')->references('id');

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
        Schema::dropIfExists('lead_products');
    }
};
