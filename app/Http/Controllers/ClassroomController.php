<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storeclassroom;
use App\Models\classroom;
use App\Models\grade;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $Classes = classroom::all();
       $Grades = grade::all();
       
       return view("pages.classrooms.index",compact(["Classes","Grades"]));
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
    public function store(Storeclassroom $request)
    {
        try{
            $lists = $request->List_Classes;
         
            foreach($lists as $list){
                $myclass = new classroom();
                $myclass->name = $list["name"];
                $myclass->Grade_id = $list["Grade_id"];
                $myclass->save();

            }
      
            return redirect()->route("classrooms.index");
            
        }
        catch(Exception $e){
            return redirect()->back()->withErrors( $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
      
        $class = classroom::find($request->id)->update(
            [
                "name" => $request->name,
                "Grade_id"=>$request->Grade_id
            ]
            );
            return redirect()->route("classrooms.index");
        }
        
        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Request $request)
        {
            classroom::destroy($request->id);
            return redirect()->route("classrooms.index");
            
            
        }
        public function delete_all(Request $request){
            $delete_all = explode(",",$request->delete_all_id);
            classroom::WhereIn("id",$delete_all)->delete();
            return redirect()->route("classrooms.index");

    }
    public function fliter(Request $request){
        $Grades = grade::all();
        $Search = classroom::select("*")->where("Grade_id",$request->Grade_id)->get();
        return view("pages.classrooms.index",compact(["Grades","Search"]));
    }
}
