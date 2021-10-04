<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataLoginAdminRequest;


class AdminController extends Controller
{
    private $viewFolder = 'admin';
    private $title = "Administrator";

    public function login()
    {   
        return view(config('template.cmsTemplateBladeURL') . "login");
    }

    public function doLogin(DataLoginAdminRequest $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('cms')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with("status_login", "success")->with("message", "Login successfully");
        }
        return redirect()->route('admin.login')->with("status_login", "danger")->with("message", "Username or password is incorrect.");
    }

    public function logout()
    {
        // quan: sua doi ngay:12-4-2021
        Auth::guard('cms')->logout();
        return redirect()->route('admin.login')->with("status_login", "success")->with("message", "Logout successfully");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view(config('template.cmsTemplateBladeURL') . 'dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
