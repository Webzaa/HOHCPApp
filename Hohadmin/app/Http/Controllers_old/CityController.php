<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::User();
        
        //  $Permission = Permission::where('slug','delete-city')->get();
        //  $user->permissions()->attach($Permission);
        // dd($user->can('add-city'));
        // exit;
        
    
        $city = city::orderBy('id','desc')->paginate(5);
        return view('city.index', compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'city_name' => 'required'
        ]);
        
        city::create($request->post());

        return redirect()->route('city.index')->with('success','City has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function show(city $city)
    {
        return view('city.show',compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(city $city)
    {
        return view('city.edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, city $city)
    {
        
        //echo'<pre>';print_r($city);exit;
        
        $request->validate([
            'city_name' => 'required'
        ]);
        
        $city->fill($request->post())->save();

        return redirect()->route('city.index')->with('success','City Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(city $city)
    {
        $city->delete();
        return redirect()->route('city.index')->with('success','City has been deleted successfully');
    }
}
