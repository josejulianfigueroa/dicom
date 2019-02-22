<?php

namespace DICOM\Http\Controllers;

use PDO;
use Log;


use Illuminate\Http\Request;
use DICOM\Http\Requests\LoginRequest;

use Session;
use Redirect;
use DICOM\User;


class LogController extends Controller
{
   public function store(LoginRequest $request){

   $user = User::where('usuario', $request->usuario)->where('clave', $request->password)->first();

   if ($user){

   		Session::put('nombre',$user->nombre);
      Session::put('idusuario',$user->id);
      Session::put('rol',$user->rol);
   		return Redirect::to('/');
   }

   	else{

   		Session::flash('message-error','Datos incorrectos');
   		return Redirect::to('log');
   	}

   }
   public function index(){
   	return view('log.store');
   }

    public function logout(){
    	Session::flush();
   		return Redirect::to('/');
   }
}
