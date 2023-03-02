<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
  public function login (){
    return view("login");
  }
  public function loginrequest ( request $request ){
   if(Auth::attempt($request->except("_token"))){
    return redirect("go");
   }else 
   return redirect("/");


  }

}
