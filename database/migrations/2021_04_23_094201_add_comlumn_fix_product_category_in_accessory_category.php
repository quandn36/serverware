<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComlumnFixProductCategoryInAccessoryCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accessory_categories', function (Blueprint $table) {
            $table->dropColumn('product_category_id');
        });
        Schema::table('accessory_categories', function (Blueprint $table) {
            $table->longText('product_category_id')->after('parent_category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accessory_categories', function (Blueprint $table) {
            //
        });
    }
}
