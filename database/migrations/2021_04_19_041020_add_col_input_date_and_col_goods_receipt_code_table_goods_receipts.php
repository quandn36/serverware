<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\GoodsReceipt;

class AddColInputDateAndColGoodsReceiptCodeTableGoodsReceipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_receipts', function (Blueprint $table)
        {
            $table->string('goods_receipt_code')->after('id')->default('0');
            $table->timestamp('input_date')->after('goods_receipt_code');
        });

        $goodsReceipts = GoodsReceipt::where('goods_receipt_code', '0')->get();

        foreach($goodsReceipts as $goodsReceipt)
        {   $code = "MPL-".time();
            $goodsReceipt->goods_receipt_code =  $code;
            $goodsReceipt->save();                
        }
        Schema::table('goods_receipts', function (Blueprint $table)
        {
            $table->string('goods_receipt_code')->unique()->change();
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
