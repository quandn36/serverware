<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ChooseMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('categories')->insert(
    		[
    			[

    				'id' 						=> '1',
    				'name' 						=> 'HPE ProLiant Rack Servers',
    				'short_name' 				=> 'HPE ProLiant',
    				'code' 						=> 'DL360 Gen10',
    				'parent_category_id' 		=> '0',
    				'slug' 						=> '<p>hpe-proliant-rack-servers</p>',
    				'short_name_description' 	=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'long_description' 			=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/server.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/server.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '1',

    			],
    			[

    				'id' 						=> '2',
    				'name' 						=> 'HPE MSA & StoreEasy Storage',
    				'short_name' 				=> 'HPE MSA',
    				'code' 						=> '2050',
    				'parent_category_id' 		=> '0',
    				'slug' 						=> '<p>hpe-msa-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/dl180.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/dl180.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '1',

    			],
    			[

    				'id' 						=> '3',
    				'name' 						=> 'HPE Switches',
    				'short_name' 				=> 'HPE Switches',
    				'code' 						=> 'DL360 Gen10',
    				'parent_category_id' 		=> '0',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>The HPE Switches delivers security, agility and flexibility without compromise.</p>',
    				'long_description' 			=> '<p>The HPE Switches Server delivers security, agility and flexibility without compromise.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '1',

    			],
    			[

    				'id' 						=> '4',
    				'name' 						=> 'HPE ProLiant DL360 Gen10',
    				'short_name' 				=> 'HPE ProLiant',
    				'code' 						=> 'DL360 Gen10',
    				'parent_category_id' 		=> '1',
    				'slug' 						=> '<p>hpe-proliant-rack-servers</p>',
    				'short_name_description' 	=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'long_description' 			=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			]
    			,
    			[

    				'id' 						=> '5',
    				'name' 						=> 'HPE ProLiant DL360 Gen10',
    				'short_name' 				=> 'HPE ProLiant',
    				'code' 						=> 'DL360 Gen10',
    				'parent_category_id' 		=> '1',
    				'slug' 						=> '<p>hpe-proliant-rack-servers</p>',
    				'short_name_description' 	=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'long_description' 			=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			],
    			[

    				'id' 						=> '6',
    				'name' 						=> 'HPE ProLiant DL360 Gen10',
    				'short_name' 				=> 'HPE ProLiant',
    				'code' 						=> 'DL360 Gen10',
    				'parent_category_id' 		=> '1',
    				'slug' 						=> '<p>hpe-proliant-rack-servers</p>',
    				'short_name_description' 	=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'long_description' 			=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			],
    			[

    				'id' 						=> '7',
    				'name' 						=> 'HPE ProLiant DL360 Gen10',
    				'short_name' 				=> 'HPE ProLiant',
    				'code' 						=> 'DL360 Gen10',
    				'parent_category_id' 		=> '1',
    				'slug' 						=> '<p>hpe-proliant-rack-servers</p>',
    				'short_name_description' 	=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'long_description' 			=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			],
    			[

    				'id' 						=> '8',
    				'name' 						=> 'HPE ProLiant DL360 Gen10',
    				'short_name' 				=> 'HPE ProLiant',
    				'code' 						=> 'DL360 Gen10',
    				'parent_category_id' 		=> '1',
    				'slug' 						=> '<p>hpe-proliant-rack-servers</p>',
    				'short_name_description' 	=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'long_description' 			=> '<p>The HPE ProLiant DL360 Gen10 Server delivers security, agility and flexibility without compromise.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			],

    			[

    				'id' 						=> '9',
    				'name' 						=> 'HPE MSA 1050',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '2',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			]
    			,

    			[

    				'id' 						=> '10',
    				'name' 						=> 'HPE MSA 1050',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '2',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			],

    			[

    				'id' 						=> '11',
    				'name' 						=> 'HPE MSA 1050',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '2',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			],

    			[

    				'id' 						=> '12',
    				'name' 						=> 'HPE MSA 1050',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '2',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			],

    			[

    				'id' 						=> '13',
    				'name' 						=> 'HPE MSA 1050',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '2',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			],

    			[

    				'id' 						=> '14',
    				'name' 						=> 'HPE MSA 1050',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '2',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',

    			]
    			,
    			[
    				
    				'id' 						=> '15',
    				'name' 						=> 'HPE OfficeConnect 1850 Switch Series',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '3',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',
    				
    			]
    			,
    			[
    				
    				'id' 						=> '16',
    				'name' 						=> 'Arista 7050SX 10/40G Data Center Switch Series',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '3',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',
    				
    			]
    			,
    			[
    				
    				'id' 						=> '17',
    				'name' 						=> 'Arista 7050SX 10/40G Data Center Switch Series<',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '3',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',
    				
    			]
    			,
    			[
    				
    				'id' 						=> '18',
    				'name' 						=> 'Arista 7050TX 10/40G Data Center Switch Series',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '3',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',
    				
    			]
    			,
    			[
    				
    				'id' 						=> '19',
    				'name' 						=> 'HPE OfficeConnect 1850 Switch Series',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '3',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',
    				
    			],
    			[
    				
    				'id' 						=> '20',
    				'name' 						=> 'HPE OfficeConnect 1850 Switch Series',
    				'short_name' 				=> 'HPE MSA ',
    				'code' 						=> '1050',
    				'parent_category_id' 		=> '3',
    				'slug' 						=> '<p>hpe-switchs-servers</p>',
    				'short_name_description' 	=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'long_description' 			=> '<p>Affordable, high-performance shared storage designed for affordable application acceleration.</p>',
    				'cover_image' 				=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'brand_image_logo'			=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}' ,
    				'image_banner_category' 	=> '{"url":"\/trang-chu\/templates\/serverware\/images\/DL360-gen10-8SFF.png","alt_text_image":"HPE ProLiant"}',
    				'menu_status' 				=> '0',
    				
    			]
    		]
    	);
}
}



