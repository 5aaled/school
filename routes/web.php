<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
route::view("show","livewire.form");
Route::group(["Middleware"=>["guest"]],function (){
   Route::get("/",function(){
        return  view("login");
    }); 
});
route::get("/dashboard",function (){
    return view("dashboard");
})->middleware("auth");
route::view("go","empty");
route::post("login",[UserController::class,"loginrequest"]);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get("/",function(){
    return  view("login");
})->name("login");

route::resource("grades",GradeController::class);
route::resource("classrooms",ClassroomController::class);
route::post("delete_all",[ClassroomController::class,"delete_all"])->name("delete_all");
route::post("Filter_Classes",[ClassroomController::class,"fliter"])->name("Filter_Classes");

route::resource("sections",SectionController::class);
route::get("wild",[SectionController::class,"index"]);

route::get("classes",[SectionController::class,"getclasses"]);
##############teacher 
route::resource("teacher",[TeacherController::class]);