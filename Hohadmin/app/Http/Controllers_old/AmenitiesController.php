<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $Amenities = Amenities::orderBy('id','desc')->paginate(5);
        return view('Amenities.index', compact('Amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Amenities.create');
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
            'name' => 'required'
        ]);
        
        Amenities::create($request->post());

        return redirect()->route('Amenities.index')->with('success','Amenities has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenities  $amenities
     * @return \Illuminate\Http\Response
     */
    public function show(Amenities $Amenities)
    {
        return view('Amenities.show',compact('Amenities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Amenities  $amenities
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenities $Amenities)
    {
        return view('city.edit',compact('Amenities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Amenities  $amenities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Amenities $Amenities)
    {
        //echo'<pre>';print_r($city);exit;
        
        $request->validate([
            'name' => 'required'
        ]);
        
        $Amenities->fill($request->post())->save();

        return redirect()->route('Amenities.index')->with('success','Amenities Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amenities  $amenities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amenities $Amenities)
    {
        $Amenities->delete();
        return redirect()->route('Amenities.index')->with('success','Amenities has been deleted successfully');
    }
}
