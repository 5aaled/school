<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\grade;
use App\Models\section;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $Grades = grade::with(["sections"])->get();
      $List_Grades = grade::all();
      return view("pages.sections.index",compact(["Grades","List_Grades"]));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
      try{
            $sections = new section();
            $sections->name = $request->name;
            $sections->Grade_id = $request->Grade_id;
            $sections->classroom_id  = $request->Class_id;
            $sections->status = 1;
            $sections->save();
            return redirect()->route("sections.index");
      }
      catch(Exception $e){
        return redirect()->back()->withErrors($e->getMessage());
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(section $section)
    {
        //
    }
    public function getclasses($id){
        $List_Classes = classroom::where("Grade_id",$id)->pluck("name","id");
        return $List_Classes;
    }
}
