<?php

namespace App\Http\Controllers;

use App\Http\Requests\Grade as RequestsGrade;
use App\Models\classroom;
use App\Models\grade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = grade ::all();
        //  ()->success('Data has been saved successfully!');

        return view("pages.grades.grades",compact("Grades"));
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
    public function store(RequestsGrade $request)
    
    {
    // check if the name exists or not
    // if(grade::where("name",$request->name)->exists()){
    //     return redirect()->back()->withErrors("the name already exists");
    // }
    //  $validate = $request->validated();
     $grade = grade::create($request->except("_token")); 
     return redirect()->route("grades.index");  
    }

    /**
     * Display the specified resource.
     */
    public function show(grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( RequestsGrade $request)
    {
        // $validate =  $request->validated();
        grade::findorfail($request->id)->update(
           ["name" => $request->name,
            "notes" => $request->notes
        ]);
        return redirect()->route("grades.index");
        
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)

    {
        #make the relation between grade and classrooms restrict on delete or make the next validation 
        $classrooms = classroom::where("Grade_id",$request->id)->pluck('Grade');

        if($classrooms->count == 0){
            
                    grade::destroy($request->id);
                    return redirect()->route("grades.index");


        }else{
            return redirect()->route("grades.index");
            #u should leave message using toster 
        }
        
    }
}
