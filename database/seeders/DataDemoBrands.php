<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class DataDemoBrands extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=10; $i++){
    		Brand::create([
    			'name'      => 'HPE MSA ' . $i,
    			'cover_image'		=> '{"url":"\/upload\/thu-vien-media\/files\/msa-2040-front-angle-600px.png","alt_text_image":null}',
    		]);
    	}
    }
}
