<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;

Use DB;

class MasterController extends Controller
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
        $Master = Master::orderBy('id','desc')->paginate(10);
        return view('Master.index', compact('Master'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = DB::table('master')
        ->select('type')
        ->groupBy('type')
        ->get();

        $sub_types = DB::table('master')
        ->select('sub_type')
        ->groupBy('sub_type')
        ->get();
        return view('Master.create', [
            'all_types' => $types,
            'all_sub_types' => $sub_types,
            
        ]);
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
            'type' => 'required',
            'sub_type' => 'required'
        ]);
        
        Master::create($request->post());

        return redirect()->route('Master.index')->with('success','Master has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function show(Master $Master)
    {
        return view('Master.show',compact('Master'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function edit(Master $Master)
    {
        $types = DB::table('master')
        ->select('type')
        ->groupBy('type')
        ->get();

        $sub_types = DB::table('master')
        ->select('sub_type')
        ->groupBy('sub_type')
        ->get();
        return view('Master.edit', [
            'all_types' => $types,
            'all_sub_types' => $sub_types,
            'Master' => $Master           
        ]);
        //return view('Master.edit',compact('Master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Master $Master)
    {
        $request->validate([
            'type' => 'required',
            'sub_type' => 'required'
        ]);
        
        $Master->fill($request->post())->save();

        return redirect()->route('Master.index')->with('success','Master Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function destroy(Master $Master)
    {
        $Master->delete();
        return redirect()->route('Master.index')->with('success','Master has been deleted successfully');
    }
}
