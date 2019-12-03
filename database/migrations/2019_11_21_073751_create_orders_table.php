<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('orders', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->string('payment', 50)->default(NULL)->comment('实际支付金额, 精确2位数字，单位：元');
//            $table->tinyInteger('pay_type')->default(NULL)->comment('支付类型 1: 在线支付 ，2：货到付款');
//            $table->string('post_fee', 50)->default(NULL)->comment('邮费, 精确2位数字，单位：元');
//            $table->tinyInteger('status')->default(NULL)->comment('状态： 1: 未付款 ，2：已付款，3：未发货，4:已发货，5：交易成功,6:交易失败');
//            $table->tinyInteger('status')->default(NULL)->comment('状态： 1: 未付款 ，2：已付款，3：未发货，4:已发货，5：交易成功,6:交易失败');
//
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('orders');
    }
}
