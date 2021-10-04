<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Server;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Helpers\CartHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('categories')) 
        {
            $categoriesFooter = Category::where('parent_category_id',0) ->with('childrenCategories')->get();
            if (!empty($categoriesFooter )) {
                View::share('categoriesFooter', $categoriesFooter);
            }
        }

        if(Schema::hasTable('categories')) {
            $allCate = Category::where('menu_status',1)->get();
            if (!$allCate->isEmpty())
            {
                $data = array();
                for($i=0; $i<count($allCate); $i++) {
                    $item = Category::where('parent_category_id',$allCate[$i]->id)->get();
                    array_push($data, $item);
                }
                // dd($data );
                // code thuc hien load menu o day
                if (!empty($allCate)) {
                    View::share(['allCate' => $allCate,'data' => $data]);
                    // dd($allCate);
                }
            } else {
                $allCate = [];
                View::share(['allCate' => $allCate]);
            }  
        }



        view()->composer('*',function($view){
            $view->with([
                'cart' => new CartHelper(),
            ]);
        });

    }
}
