<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ConfigController extends Controller
{
    private $viewFolder = 'configs';

    /**
     * get all parent category have parent id = 0
     * send it into view choose-menus
     * 
     */
    public function index()
    {
        $pageInfo = [
            'page' => $this->viewFolder,
        ];

        $allParentCate = Category::where('parent_category_id','=',0)->get();

        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.choose-configs", compact('pageInfo','allParentCate'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $alldata = Category::all();

        if(isset($_POST['check']))
        {
            foreach($alldata as $value)
            {
                $category = Category::find($value->id);
                if($category != null)
                {
                    if ($category->menu_status == 1) {
                    echo $category->id . ' có menu status = ' . $category->menu_status  . '<br>';
                        $category->menu_status = 0;
                    }
                    $category->save();
                }
            }

            // data do nguoi dung chon se load len view
            $data = $_POST['check'];

            // dd($request);
            foreach($data as $id)
            {
                $category = Category::find($id);
                if ($category != null) {
                    $category->menu_status = 1;
                }
                $category->save();

            }
            return redirect()->back()->with('status','success');


        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
