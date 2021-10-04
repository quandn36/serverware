<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Supplier;

class AddColSupllierCodeTableSuppliers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table)
        {
            $table->string('supplier_code')->after('id')->default('0');
        });

        $suppliers = Supplier::where('supplier_code', '0')->get();

        foreach($suppliers as $key => $supplier)
        {   $code = "SLR-".$key;
            $supplier->supplier_code =  $code;
            $supplier->save();                
        }
        
        Schema::table('suppliers', function (Blueprint $table)
        {
            $table->string('supplier_code')->unique()->change();
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
