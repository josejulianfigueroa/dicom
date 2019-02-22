<?php

namespace DICOM\Http\Controllers;

use Illuminate\Http\Request;
use DICOM\User;
use DICOM\WalmartGrbacionModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class WalmartGrbacion extends Controller
{
    public function store(Request $request){

    	  $mytime=Carbon::now('America/Santiago')->format('ymd');
         // $mytime=date("YYmd",strtotime($mytime));

     $rut =$request->get('rut_graba');
     $id= '0';
     $modela = WalmartGrbacionModel::where('rut','=',$rut)
     						->where('activo','=','1')
     						->get();
     					
// get() retorna una array, de otro modo retorna una coleccion

     if ($modela == '[]'){
     	return view('walmart.index',['status'=>'EL rut no está activo para la carga de grabación','cod'=>'1']);
     }
     	else{



     	$id = $modela['0']->id;
     	$modelo = WalmartGrbacionModel::findOrFail($id);
    	$modelo->activo='0';
    	if(Input::hasFile('imagen')){
    		$file = Input::file('imagen');
    		$file->move(public_path().'/grabaciones_wal/',$rut .'_'.$modelo->coti_numero.'_968.WAV');
    		//$file->getClientOriginalName()
    		$modelo->nombre_archivo= $rut.'_'.$modelo->coti_numero.'_968.MP3';
    		$modelo->codigo_usuario= $mytime.$modelo->coti_numero.'968';
    	}else{
    		return view('walmart.index',['status'=>'Debe cargar el archivo para procesar esta solicitud','cod'=>'1']);
    	}
    	$modelo->update();
    	return view('walmart.index',
    	['status'=>'Carga realizada con exito: '.$rut .'_'.$modelo->coti_numero.'_968.MP3',
    		'cod'=>'0',
    		'codigo_usuario'=>$mytime.$modelo->coti_numero.'968']);
    }
    	 

   
}
}