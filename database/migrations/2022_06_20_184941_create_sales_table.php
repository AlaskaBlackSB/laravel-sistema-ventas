<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->double('total');
            // $table->foreignId('invoice_id', 'fk_sales_invoices_invoice_id_idx')
            $table->foreignId('invoice_id')
                ->nullable()
                ->default(null)
                ->references('id')->on('invoices')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('product_id', 'fk_sales_products_product_id_idx')
                ->references('id')->on('products')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('user_id', 'fk_sales_users_user_id_idx')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
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
        Schema::dropIfExists('sales');
    }
}
