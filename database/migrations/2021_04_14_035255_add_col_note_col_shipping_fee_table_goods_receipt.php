<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColNoteColShippingFeeTableGoodsReceipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('goods_receipts', function (Blueprint $table) {
            $table->dropColumn('total_price');
            $table->dropColumn('accessory_id');
            $table->dropColumn('qty_accessory');
        });
        Schema::table('goods_receipts', function (Blueprint $table) {
           $table->longtext('accessories')->after('supplier_id');
           $table->float('total_price')->default(0)->after('accessories');
           $table->float('shipping_fee')->default(0)->after('total_price');
           $table->float('total_money')->default(0)->after('shipping_fee');
           $table->string('note')->nullable()->after('total_money');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
