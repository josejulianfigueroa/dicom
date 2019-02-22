<?php

namespace DICOM\Http\Controllers;

use Illuminate\Http\Request;
//use DICOM\Http\Requests\DicomFormRequest;
use DB;
use PDO;
use Session;
use Redirect;
use DICOM\ConvenioModel;
use DICOM\ConvenioValidacionModel;
use DICOM\User;
use Carbon\Carbon;
use DateTime;
use Log;
use Validator;
use Illuminate\Support\Facades\Input;
use Excel;


class ConveniosController extends Controller
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
    
             if($request){
            $mytime=Carbon::now('America/Santiago');
            
            $searchEjecutivo = DB::select("select u.id,u.nombre from usuario u,campania_usuario c
 where u.id = c.idusuario and  c.estado = true and  u.estado = true and u.userarea is null
and (c.idcliente = 84 or c.idcliente = 83 or c.idcliente = 60 or c.idcliente = 68)
order by u.nombre");

            /*DB::table('usuario as u')
            ->join('campania_usuario as x',function($join){
                    $join->on('x.idusuario','=','u.id');
                })
            ->select('u.id','u.nombre')
            //->where('u.perfil','=','2')
            ->where('u.estado','=','true')
            ->where('x.estado','=','true')
            ->whereNull('u.userarea')
            ->where('x.idcliente','=','60')
            ->orwhere('x.idcliente','=','68')
            ->orwhere('x.idcliente','=','84')
            ->orwhere('x.idcliente','=','83')
            ->orderBy('u.nombre')->get();*/

$searchEfitramo = DB::select("select u.id,u.nombre from usuario u,cartera_usuario c
 where u.id = c.idusuario and  c.estado = true 
and (c.idcliente = 84 or c.idcliente = 83 or c.idcliente = 60 or c.idcliente = 68)
group by u.id,u.nombre
order by u.nombre");


            $nombre='';
            $nombre2='';
            $searchEjecutivo2='';
            $searchEfitramo2='';
            $ban11='0';
            $ban21='0';

            if(isset($request) && $request->get('searchEjecutivo2') != 'Seleccionar' && $request->get('searchEjecutivo2')  !== null)
            {
            $searchEjecutivo2=$request->get('searchEjecutivo2');
            $name = explode('-',$searchEjecutivo2);
            $id = $name[0];
             Log::info($id);
            $nombre = $name[1];
              Log::info($nombre);
                $ban11='1';
           
            }

            if(isset($request) && $request->get('searchEfitramo2') != 'Seleccionar' && $request->get('searchEfitramo2')  !== null)
            {
            $searchEfitramo2=$request->get('searchEfitramo2');
            $name = explode('-',$searchEfitramo2);
            $id2 = $name[0];
             Log::info($id2);
            $nombre2 = $name[1];
              Log::info($nombre2);
               $ban21='1';
            }

           // if ($fecha2 == "") {$fecha2=date("d-m-Y",strtotime($mytime->toDateTimeString()));}

              if(isset($request) && $request->get('exp') == '1')
                {
            $lista= DB::table('efi_convenios_pago as c')
            ->join(DB::raw("(select idcliente_origen,rut , max(nro_convenio) as nro_convenio 
                from efi_convenios_pago 
                group by idcliente_origen,rut) as color"),function($join){
                $join->on("color.idcliente_origen","=","c.idcliente_origen");
                $join->on("color.rut","=","c.rut");
                $join->on("color.nro_convenio","=","c.nro_convenio");
                })
//(select nombre from usuario f where f.id::int = a.codigo_usuario_autoriza::int) as autorizador
             ->leftjoin('efi_convenios_validacion as va', 'va.idconvenio', '=','c.id')
             ->leftjoin('cliente as cli', 'cli.id', '=','c.idcliente_origen')
             ->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.codigo_usuario as int)'))
             ->select('c.id as id','c.rut as rut','cli.nombre as Cliente','c.nro_convenio as nro',DB::raw('CAST(c.fecha_convenio as date) as fecha_convenio'),'c.monto_convenio as monto_convenio','c.monto_cuotas as monto_cuotas','u.nombre as nombre','c.estado_tabla_a as estado_convenio','c.monto_deuda','c.monto_dcto','c.abono_inicial','c.total_cuotas','c.primer_vcto','c.tipo_ajuste','c.fecha_abono','c.fecha_vigente','c.fecha_roto','c.fecha_cancelado','c.pagare','c.cuoton','c.fecha_actual as fecha_real','c.fecha_pagare_firmado','c.fecha_pagare_generado','c.fecha_pagare_ingreso','c.fecha_entrega_pagare'); 



                }else{
 DB::select("delete from efi_convenios_temporales_app");

 DB::select("insert into efi_convenios_temporales_app select va.id as id_va,va.idconvenio as va_idconvenio,va.contacto as va_contacto,va.convenio as va_convenio,va.observacion as va_observacion,c.id as id,c.rut as rut,
c.idcliente_origen as idcliente,c.idcampania_origen as idcampania,c.nro_convenio as nro
,c.fecha_convenio::date as fecha_convenio,c.monto_convenio as monto_convenio,c.monto_cuotas as monto_cuotas,
u.nombre as nombre,c.estado_auditado as estado,c.estado_tabla_a,c.monto_deuda,c.monto_dcto,
c.abono_inicial,c.total_cuotas,c.primer_vcto,c.tipo_ajuste,c.fecha_abono,c.fecha_vigente,c.fecha_roto,c.fecha_cancelado,
c.codigo_usuario_autoriza,c.pagare,c.cuotas_pagadas,c.cuota_morosa_total,c.cuoton,c.fecha_actual,c.codigo_usuario,c.fecha_pagare_firmado,c.fecha_pagare_generado,c.fecha_pagare_ingreso,c.fecha_entrega_pagare
from efi_convenios_pago c
inner join 
(select a.idcliente_origen as idcliente_origen,a.rut as rut, max(a.nro_convenio) as nro_convenio
                from efi_convenios_pago a
                group by a.idcliente_origen,a.rut) p on p.idcliente_origen::int = c.idcliente_origen::int and p.rut::int = c.rut::int and c.nro_convenio::int=p.nro_convenio::int
left join efi_convenios_validacion va on va.idconvenio = c.id
inner join usuario u on u.id::int = c.codigo_usuario::int
order by c.fecha_convenio::date desc");

$lista= DB::table('efi_convenios_temporales_app as c')
->select('c.id_va as idconvenio','c.va_idconvenio','c.va_contacto as contacto','c.va_convenio as convenio','c.va_observacion as observacion','c.id as id','c.rut as rut','c.idcliente as idcliente','c.idcampania as idcampania','c.nro',DB::raw('CAST(c.fecha_convenio as date) as fecha_convenio'),'c.monto_convenio as monto_convenio','c.monto_cuotas as monto_cuotas','c.nombre','c.estado','c.estado_tabla_a as estado_tabla_a','c.monto_deuda','c.monto_dcto','c.abono_inicial','c.total_cuotas','c.primer_vcto','c.tipo_ajuste','c.fecha_abono','c.fecha_vigente','c.fecha_roto','c.fecha_cancelado','c.codigo_usuario_autoriza','c.codigo_usuario','c.pagare','c.cuotas_pagadas','c.cuota_morosa_total','c.cuoton','c.fecha_actual','c.fecha_pagare_firmado','c.fecha_pagare_generado','c.fecha_pagare_ingreso','c.fecha_entrega_pagare')
->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.codigo_usuario as int)')); 

          /*  $lista= DB::table('efi_convenios_pago as c')
            ->join(DB::raw("(select idcliente_origen,rut , max(nro_convenio) as nro_convenio 
                from efi_convenios_pago 
                group by idcliente_origen,rut) as color"),function($join){
                $join->on("color.idcliente_origen","=","c.idcliente_origen");
                $join->on("color.rut","=","c.rut");
                $join->on("color.nro_convenio","=","c.nro_convenio");
                })
                */
//(select nombre from usuario f where f.id::int = a.codigo_usuario_autoriza::int) as autorizador
                /*
                $lista= DB::table('efi_convenios_pago as c')
                ->join(DB::raw("(select idcliente_origen,rut ,nro_convenio as nro_convenio 
                from efi_convenios_temporales_app) as color"),function($join){
                $join->on("color.idcliente_origen","=","c.idcliente_origen");
                $join->on("color.rut","=","c.rut");
                $join->on("color.nro_convenio","=","c.nro_convenio");
                })

             ->leftjoin('efi_convenios_validacion as va', 'va.idconvenio', '=','c.id')
             */
             
             /*
             ->select('va.id','va.idconvenio','va.contacto','va.convenio','va.observacion','c.id as id','c.rut as rut','c.idcliente_origen as idcliente','c.idcampania_origen as idcampania','c.nro_convenio as nro',DB::raw('CAST(c.fecha_convenio as date) as fecha_convenio'),'c.monto_convenio as monto_convenio','c.monto_cuotas as monto_cuotas','u.nombre as nombre','c.estado_auditado as estado','c.estado_tabla_a as estado_tabla_a','c.monto_deuda','c.monto_dcto','c.abono_inicial','c.total_cuotas','c.primer_vcto','c.tipo_ajuste','c.fecha_abono','c.fecha_vigente','c.fecha_roto','c.fecha_cancelado','c.codigo_usuario_autoriza','c.pagare','c.cuotas_pagadas','c.cuota_morosa_total','c.cuoton','c.fecha_actual'); 

             */
              }

            if (  $ban11 =='1' && $ban21 =='1'){

                $searchEjecutivo_aux2=(int)$id2;
                if ($id2 == '1'){
                 $lista->where(DB::raw('CAST(c.codigo_usuario as int)'),'=',DB::raw('CAST(u.id as int)'));
                $lista->whereNull('u.userarea');
                }else{
                $lista->where(DB::raw('CAST(c.codigo_usuario as int)'),'=',$searchEjecutivo_aux2);
              }
            }
              else{

             if(isset($request) && $request->get('searchEfitramo2') != 'Seleccionar' && $request->get('searchEfitramo2')  !== null)
            
            {
              $searchEjecutivo_aux2=(int)$id2;
               if ($id2 == '1'){
                 $lista->where(DB::raw('CAST(c.codigo_usuario as int)'),'=',DB::raw('CAST(u.id as int)'));
                 $lista->whereNull('u.userarea');
                }else{
                
                $lista->where(DB::raw('CAST(c.codigo_usuario as int)'),'=',$searchEjecutivo_aux2);
              }
            }

            if(isset($request) && $request->get('searchEjecutivo2') != 'Seleccionar' && $request->get('searchEjecutivo2')  !== null)
            {
            $searchEjecutivo_aux= (int)$id;
            $lista->where(DB::raw('CAST(c.codigo_usuario as int)'),'=',$searchEjecutivo_aux);
            }
            
              }




            if(isset($request) && $request->get('searchText') != '' && $request->get('searchText')  !== null)
            {
            $query= strtolower(trim($request->get('searchText')));
            $lista->whereRaw( 'LOWER(c.rut) like ?', array( '%'.$query.'%' ) );
            }else {$query='';}

            if(isset($request) && $request->get('searchEstado') != '' && $request->get('searchEstado')  !== null)
            {
            $searchEstado= trim($request->get('searchEstado'));
            $lista->where('c.estado_auditado','=',$searchEstado);
            }else {$searchEstado='';}
      
            if(isset($request) && $request->get('searchFecha1') != '' && $request->get('searchFecha1')  !== null)
            {
            $fecha1= trim($request->get('searchFecha1'));
            $lista->where(DB::raw('CAST(c.fecha_convenio as date)'),'>=',new DateTime($fecha1));
            }else {$fecha1='';}

            if(isset($request) && $request->get('searchFecha2') != '' && $request->get('searchFecha2')  !== null)
            {
            $fecha2= trim($request->get('searchFecha2'));
            $lista->where(DB::raw('CAST(c.fecha_convenio as date)'),'<=',new DateTime($fecha2));
            }else {$fecha2='';}


           if(isset($request) && $request->get('searchFecha1v') != '' && $request->get('searchFecha1v')  !== null)
            {
            $fecha1v= trim($request->get('searchFecha1v'));
            $lista->where(DB::raw('CAST(c.fecha_vigente as date)'),'>=',new DateTime($fecha1v));
            }else {$fecha1v='';}

            if(isset($request) && $request->get('searchFecha2v') != '' && $request->get('searchFecha2v')  !== null)
            {
            $fecha2v= trim($request->get('searchFecha2v'));
            $lista->where(DB::raw('CAST(c.fecha_vigente as date)'),'<=',new DateTime($fecha2v));
            }else {$fecha2v='';}


            if(isset($request) && $request->get('searchEstadoA') != '' && $request->get('searchEstadoA')  !== null)
            {
            $searchEstadoA= trim($request->get('searchEstadoA'));
            $lista->where('c.estado_tabla_a','=',$searchEstadoA);
            }else {$searchEstadoA='';}

            if(isset($request) && $request->get('searchEstadoC') != '' && $request->get('searchEstadoC')  !== null)
            {
            $searchEstadoC= trim($request->get('searchEstadoC'));
            $lista->where('c.idcliente_origen','=',$searchEstadoC);
            }else {$searchEstadoC='';}

            $searchPagare= null;
             if($request->get('searchPagare') == 'SI')
            {
            $searchPagare='SI';
            $lista->where('c.fecha_pagare_generado','!=',null);
            }
            if ($request->get('searchPagare') == 'NO')
            {
            $searchPagare='NO';
            $lista->where('c.fecha_pagare_generado','=',null);
            }





           if(isset($request) && $request->get('exp') == '1')
                {
  $lista=  $lista->orderBy(DB::raw('CAST(c.fecha_convenio as date)'),'desc')->get();    
    
     $lista2 = json_decode(json_encode($lista), true);
     
Excel::create('Convenios', function($excel) use($lista2) {

    //$lista1 = $lista;

    $excel->sheet('Convenios_Ejecutivos', function($sheet) use($lista2) {

         $sheet->fromArray($lista2);
         //$sheet->fromModel($lista2);

    });

})->export('xls');     
                }


                else{
 //$lista  = ConvenioModel::orderBy('id', 'desc')->paginate(10);
   $lista=  $lista->orderBy(DB::raw('CAST(c.fecha_convenio as date)'),'desc')
            ->distinct('c.id')->Paginate(10);   
                

//$lista=  $lista->orderBy(DB::raw('CAST(c.fecha_convenio as date)'),'desc')->limit(5)->get();
    return view('convenios.index',['lista'=>$lista,'searchText'=>$query,'searchFecha1'=>$fecha1,'searchFecha2'=>$fecha2,'searchFecha1v'=>$fecha1v,'searchFecha2v'=>$fecha2v,'searchEstado'=>$searchEstado,'searchEjecutivo'=>$searchEjecutivo,'searchEjecutivo2'=>$searchEjecutivo2,'nombre'=>$nombre,'searchEstadoA'=>$searchEstadoA,'searchEstadoC'=>$searchEstadoC,'searchEfitramo'=>$searchEfitramo,'searchEfitramo2'=>$searchEfitramo2,'nombre2'=>$nombre2,'searchPagare'=>$searchPagare]);
     } 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {  
            
        if ($request->ban == "0"){

        $validator = Validator::make($request->all(), [
            'codigo_usuario_autoriza' => 'required',
            'rut' =>'required',
            'cliente' =>'required'
        ]);

        
        if ($validator->passes()) {

            Log::info("Dentro del store, llamada Ajax");
            Log::info("cod:".$request->codigo_usuario_autoriza);

            //Buscamos el usuario que autoriza el convenio
            $user = User::where('id',$request->codigo_usuario_autoriza)->first();
            Log::info("Usuario:".$user->nombre);


  //----------------------------------------------------------------------------Extraer Direccion
 $results1 = DB::select("Select (trim(coalesce(direccion,'')) ||', Comuna: '||trim(coalesce(comuna,''))||', Ciudad: '||trim(coalesce(ciudad,''))||', Region: '||trim(coalesce(region,''))) as dire from efi_direcciones_general  where rut=:id  and estado_direccion='valido' limit 1", [ 'id' => $request->rut]);
        $v1['dire']='Sin Dirección';   
        $arr1 = json_decode(json_encode($results1), true);
                foreach ($arr1 as $k1=>$v1){    
                        Log::info("Dire:".$v1['dire']); 
                        }
 //----------------------------------------------------------------------------Extraer Email
 $results0 = DB::select("select email from efi_email_cliente_rut where rut = :id and estado_email='valido' limit 1", [ 'id' => $request->rut]);
        $v0['email']='Sin email';
        $arr0 = json_decode(json_encode($results0), true);
                foreach ($arr0 as $k0=>$v0){    
                        Log::info("email:".$v0['email']); 
                        }

//----------------------------------------------------------------------------Extraer Nombre
            //Buscamos el nombre del cliente PRESTO
            if($request->cliente == 'Presto'){

           

$id_campa = DB::select("SELECT a.id as id FROM campania a INNER JOIN base b ON b.idcliente = a.idcliente AND b.idcampania = a.id AND b.estado = TRUE WHERE a.idcliente = 60 AND a.nombre LIKE '%ompleta%' ORDER BY a.id DESC LIMIT 1");
  foreach ($id_campa as $var1)
      {
     //   echo $var1->id;
      }

 Log::info("ID Campania:".$var1->id);

  $tabla= sprintf("a%03d%03d001",60,$var1->id);
            $tabla=(string)$tabla;
            Log::info("Tabla A Presto:".$tabla);

    $results = DB::select("SELECT nombre,cuotas_pagadas,cuota_actual FROM ".$tabla." WHERE rut = :id limit 1", [ 'id' => $request->rut]);
        
        $arr = json_decode(json_encode($results), true);
                foreach ($arr as $k=>$v){
                        Log::info($v['nombre']); 
                        }

            /*foreach ($results as $user) {
                $nombre = $user->usuario;   
            } */    
            // Log::info("Nombre del Cliente:".$v['nombre']);
            }



        //Buscamos el nombre del cliente WALMART
            if($request->cliente == 'Walmart'){
$id_campa = DB::select("SELECT a.id as id FROM campania a INNER JOIN base b ON b.idcliente = a.idcliente AND b.idcampania = a.id AND b.estado = TRUE WHERE a.idcliente = 83 AND a.nombre LIKE '%ompleta%' ORDER BY a.id DESC LIMIT 1");
  foreach ($id_campa as $var1)
      {
       //echo $var1->id;
      }

 Log::info("ID Campania:".$var1->id);

            $tabla= sprintf("a%03d%03d001",83,$var1->id);
            $tabla=(string)$tabla;
            Log::info("Tabla A Walmart:".$tabla);

    $results = DB::select("SELECT nombre,cuotas_pagadas,cuota_actual FROM ".$tabla." WHERE rut = :id limit 1", [ 'id' => $request->rut]);
        
        $arr = json_decode(json_encode($results), true);
                foreach ($arr as $k=>$v){
                        Log::info($v['nombre']); 
                        }

            }




        //Buscamos el nombre del cliente EFICAZ
            if($request->cliente == 'Eficaz'){

$id_campa = DB::select("SELECT a.id as id FROM campania a INNER JOIN base b ON b.idcliente = a.idcliente AND b.idcampania = a.id AND b.estado = TRUE WHERE a.idcliente = 84 AND a.nombre LIKE '%ompleta%' ORDER BY a.id DESC LIMIT 1");
  foreach ($id_campa as $var1)
      {
      //  echo $var1->id;
      }
Log::info("ID Campania:".$var1->id);
            $tabla= sprintf("a%03d%03d001",84,$var1->id);
            $tabla=(string)$tabla;
            Log::info("Tabla A Eficaz:".$tabla);

    $results = DB::select("SELECT nombre,cuotas_pagadas,cuota_actual FROM ".$tabla." WHERE rut = :id limit 1", [ 'id' => $request->rut]);
        
        $arr = json_decode(json_encode($results), true);
                foreach ($arr as $k=>$v){
                        Log::info($v['nombre']); 
                        }

            }


            //Buscamos el nombre del cliente SANTANDER
            if($request->cliente == 'Santander'){

$id_campa = DB::select("SELECT a.id as id FROM campania a INNER JOIN base b ON b.idcliente = a.idcliente AND b.idcampania = a.id AND b.estado = TRUE WHERE a.idcliente = 68 AND a.nombre LIKE '%ompleta%' ORDER BY a.id DESC LIMIT 1");
  foreach ($id_campa as $var1)
      {
       // echo $var1->id;
      }
Log::info("ID Campania:".$var1->id);

            $tabla= sprintf("a%03d%03d001",68,$var1->id);
            $tabla=(string)$tabla;
            Log::info("Tabla A Presto:".$tabla);

    $results = DB::select("SELECT nombre,cuotas_pagadas,cuota_actual FROM ".$tabla." WHERE rut = :id limit 1", [ 'id' => $request->rut]);
        
        $arr = json_decode(json_encode($results), true);
                foreach ($arr as $k=>$v){
                        Log::info($v['nombre']); 
                        }

            }

           if ($v['cuota_actual'] == '') {$v['cuota_actual']='0';} 
           if ($v['cuotas_pagadas'] == '') {$v['cuotas_pagadas']='0';} 

            return response()->json(['success'=>$user->nombre,'nombre'=>$v['nombre'],'cuotas_pagadas'=>$v['cuotas_pagadas'],'cuota_actual'=>$v['cuota_actual'],'email'=>$v0['email'],'dire'=>$v1['dire']]);
        }
      
        return response()->json(['error'=>$validator->errors()->all()]);
    }
       if ($request->ban == "1"){
            $mytime=Carbon::now('America/Santiago');
            $mytime=date("d-m-Y h:i:s",strtotime($mytime));
            $motivo=$request->motivo;
            $convenio_check=$request->convenio_check;
            $cliente_check=$request->cliente_check;
            $idconvenio=$request->idconvenio;
            $bano="0";

           
            $resultado = ConvenioValidacionModel::where('idconvenio',$idconvenio)->first(); 

            if(empty($resultado->idconvenio)){
            
            DB::table('efi_convenios_validacion')->insert([
                ['observacion'=>$motivo,'contacto'=>$cliente_check,'convenio'=>$convenio_check,'idconvenio'=>$idconvenio,'idusuario'=>Session::get('idusuario'),'fecha_update'=>$mytime]
            ]);
       
            }else{
                $bano="1";
                }
        return response()->json(['nombre'=>Session::get('nombre'),'bano'=>$bano]);

       }
  if ($request->ban == "2"){
            $mytime=Carbon::now('America/Santiago');
            $mytime=date("d-m-Y h:i:s",strtotime($mytime));
            $fecha_pagare_generado=$request->fecha_pagare_generado;
            $fecha_pagare_firmado=$request->fecha_pagare_firmado;
            $fecha_entrega_pagare=$request->fecha_entrega_pagare;
            $idconvenio=$request->idconvenio;
            $bano="0";
             Log::info($fecha_entrega_pagare); 
        
            $resultado = ConvenioModel::where('id',$idconvenio)->first(); 
            $resultado->fecha_pagare_generado= $fecha_pagare_generado;
            $resultado->fecha_pagare_firmado= $fecha_pagare_firmado;
            $resultado->fecha_entrega_pagare= $fecha_entrega_pagare;
            $resultado->fecha_pagare_ingreso= $mytime;
            $resultado->update();

           
        return response()->json(['nombre'=>Session::get('nombre'),'bano'=>$bano]);

       }
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
