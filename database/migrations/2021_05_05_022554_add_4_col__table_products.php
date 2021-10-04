<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add4ColTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table)
        {   
            $table->float('price_config')->after('price')->default(0);
            $table->boolean('is_popular')->after('category_id')->default(0);
            $table->string('drive_bay_size')->after('is_popular')->default('2.5');
            $table->string('qty_drive')->after('drive_bay_size')->default('10');
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
