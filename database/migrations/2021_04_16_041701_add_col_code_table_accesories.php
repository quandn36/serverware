<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Accessory;

class AddColCodeTableAccesories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {   
       
        Schema::table('accessories', function (Blueprint $table)
        {
            $table->string('accessory_code', 40)->after('name')->default('0');
        });

        $accessories = Accessory::where('accessory_code', '0')->get();

        foreach($accessories as $key => $accessory)
        {   $code = "HD".$key;
            $accessory->accessory_code =  $code;
            $accessory->save();                
        }
        Schema::table('accessories', function (Blueprint $table)
        {
            $table->string('accessory_code')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
