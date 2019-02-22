<?php

namespace DICOM\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use PDO;
use Session;
use Redirect;
use Carbon\Carbon;
use DateTime;
use Log;
use Illuminate\Support\Facades\Input;
use Excel;

class DicomAclararController extends Controller
{
     public function __construct(){
        $this->middleware('checksesion');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       $mytime=Carbon::now('America/Santiago');
       $mytime=date("d-m-Y",strtotime($mytime));


            if(isset($request) && $request->get('searchFecha1') != '' && $request->get('searchFecha1')  !== null)
            {
            $fecha1= trim($request->get('searchFecha1'));
            }else {$fecha1=$mytime;}

            if(isset($request) && $request->get('searchFecha2') != '' && $request->get('searchFecha2')  !== null)
            {
            $fecha2= trim($request->get('searchFecha2'));
            }else {$fecha2=$mytime;}



 DB::select("delete from dicom_aclaraciones_resultantes");

$clientes = array(68,60,83,84); 

foreach ($clientes as $idcliente) {


$id_campa = DB::select("SELECT a.id as id FROM campania a INNER JOIN base b ON b.idcliente = a.idcliente AND b.idcampania = a.id AND b.estado = TRUE WHERE a.idcliente = ".$idcliente." AND a.nombre LIKE '%ompleta%' ORDER BY a.id DESC LIMIT 1");

            $tabla= sprintf("a%03d%03d001",$idcliente,$id_campa[0]->id);
            $tabla=(string)$tabla;


      DB::select("insert into dicom_aclaraciones_resultantes select a.rut, a.dv, to_char(e.fecha_protesto::Date,'dd-mm-yyyy') as fecha_protesto,
         e.numero_documento as nro_operacion
                ,a.montodeuda as monto_deuda
                , to_char(j.fecha_pago::date,'dd-mm-yyyy') as fecha_de_pago
                , case when e.idcliente = 84 then 'CXC'
                       when e.idcliente = 83 then 'WALMART'
                       when e.idcliente = 68 then 'SANTANDER'
                       else 'PRESTO' END as idcliente, e.situacion as situacion,a.estado_convenio as estado,
                       e.monto_protesto as monto_protesto

                from ".$tabla." a 
                inner join efi_dicom_lista e on a.rut = e.rut and e.idcliente::int = ".$idcliente."  

                inner join (select max(fecha_pago::date) as fecha_pago, rut from j_base_pagos_eficaz 
                    where idcliente = ".$idcliente." 
                          and fecha_pago::date >= '".$fecha1."'::date
                          and fecha_pago::date <= '".$fecha2."'::date
                    group by rut) j on j.rut = a.rut 

                where a.montodeuda::text <= '0'
                order by j.fecha_pago::date desc");

}

 $lista = DB::select("select * from dicom_aclaraciones_resultantes");

              

if(isset($request) && $request->get('exp') == '1')
                { 
  // $lista=  $lista->orderBy(DB::raw('CAST(c.fecha_convenio as date)'),'desc')->get();    
    
     $lista2 = json_decode(json_encode($lista), true);
     
Excel::create('Lista', function($excel) use($lista2) {

    //$lista1 = $lista;

    $excel->sheet('Clientes_Aclarar_Dicom', function($sheet) use($lista2) {

         $sheet->fromArray($lista2);
         //$sheet->fromModel($lista2);

    });

})->export('xls');    
                }


                else{  
                
   return view('aclarar.index',['lista'=>$lista,'searchFecha1'=>$fecha1,'searchFecha2'=>$fecha2]);

    
     } 


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
