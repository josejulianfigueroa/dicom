<?php

namespace DICOM\Http\Controllers;

use Illuminate\Http\Request;
//use DICOM\Http\Requests\DicomFormRequest;
use DB;
use PDO;
use Session;
use Redirect;
use Carbon\Carbon;
use DICOM\ConvenioModel;
use DICOM\Pagos;
use DICOM\Gestion2;
use DICOM\ConvenioValidacionModel;
use DICOM\Efi_FondoModel;
use DICOM\Efi_Comprobante_Pago_Model;
use DICOM\User;
use DateTime;
use Log;
use Validator;
use Illuminate\Support\Facades\Input;
use Excel;




class PagosController extends Controller
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
    
 $pagos='';
 $historia='';

  if(isset($request) && $request->get('tipo_pago'))
                {
    

   $mytime=Carbon::now('America/Santiago');
   $mytime=date("d-m-Y h:i:s",strtotime($mytime));
   $fecha_date=date("Y-m-d",strtotime($mytime));
   $fondo = Efi_FondoModel::where('idcliente',$request->get('idcliente0'))->first();

$maximo = DB::select("SELECT max(control::int) as control  FROM efi_comprobante_pago");
  foreach ($maximo as $varx)
      {
      //  echo $var1->id;
      }


$res = DB::select("SELECT cierre as cierre FROM efi_comprobante_pago WHERE fecha_pago::date =:id1 and cierre = '1' limit 1",['id1' => $fecha_date]);

  foreach ($res as $varcierre)
      {
      //  echo $var1->id;
      }
      if(empty($res)) {$cierre1 = 'libre';}
                        else {$cierre1='cerrado';}

if($cierre1 == 'libre'){
     DB::table('efi_comprobante_pago')->insert([
                ['idcliente'=>$request->get('idcliente0'),'idcampania'=>$request->get('idcampania0'),'idbase'=>'1','rut'=>$request->get('rut0'),'dv'=>$request->get('dv0'),'nombre'=>$request->get('nombre0'),'control'=>$varx->control+1,'fecha_actual'=>$mytime,'idusuario'=>Session::get('idusuario'),'fecha_pago'=>$mytime,'monto_pago'=>$request->get('otro_monto1'),'tipo_pago'=>$request->get('tipo_pago'),'fecha_pago'=>$mytime,'cuenta'=>$fondo->cuenta2,'cierre'=>'0']
            ]);
     $cli_nombre='vacio';
     if ($request->get('idcliente0') == '84'){$cli_nombre='EFICAZ';}
       if ($request->get('idcliente0') == '83'){$cli_nombre='WALMART';}
         if ($request->get('idcliente0') == '68'){$cli_nombre='SANTANDER';}
           if ($request->get('idcliente0') == '60'){$cli_nombre='PRESTO';}



if($request->get('tipo_pago') == 'CHEQUE' || $request->get('tipo_pago') == 'VALE VISTA' || $request->get('tipo_pago') == 'TRANSFERENCIA') 
 {$valor_aux= $request->get('otro_monto1');}
else{
   $valor_aux= $request->get('otro_monto2'); 
}


    return view('pagos.comprobante',['idcliente'=>$cli_nombre,'rut'=>$request->get('rut0'),'dv'=>$request->get('dv0'),'otro_monto1'=>$request->get('otro_monto1'),'otro_monto2'=>$valor_aux,'otro_monto3'=>$request->get('otro_monto3'),'nombre_usuario'=>Session::get('nombre'),'cuenta'=>$fondo->cuenta2,'banco'=>$fondo->banco,'fecha'=>$mytime,'nombre'=>$request->get('nombre0'),'tipo'=>$request->get('tipo_pago'),'control'=>$varx->control+1]);
                        }else{

    //return Redirect::to('/pagos')->with('status','La Caja en la fecha: '.$fecha_date.', ya está cerrada');
    return view('pagos.index',['status'=>'La Caja en la fecha: '.$fecha_date.', ya está cerrada']);

                        }

}
                else{ //BUSQUEDA DE UN RUT, PARA ESTADO DE CUENTA

     $query= strtolower(trim($request->get('searchText')));


$max_cli = DB::select("SELECT count(distinct idcliente_origen) as contador_cli  FROM efi_convenios_pago where rut = :id", [ 'id' => $query]);

  foreach ($max_cli as $varxx)
      {
      //  echo $varxx->contador_cli;
      }
      if ($varxx->contador_cli >1 and $request->get('busqueda_cliente')==null) {

  $busqueda_cliente = DB::select("select distinct c.idcliente_origen as idcliente,case when c.idcliente_origen = '84' then 'EFICAZ CXC'  when c.idcliente_origen = 83 then 'WALMART' when c.idcliente_origen = '68' then 'SANTANDER' when c.idcliente_origen = '60' then 'PRESTO' END as nombre_cli from efi_convenios_pago c where c.rut = :id", [ 'id' => $query]);

//Lista Vacia
 $lista= DB::table('efi_convenios_pago as c')
             ->select('c.id as id')
             ->where( 'c.idcliente_origen','=','999')->get();


return view('pagos.index',['status'=>'','searchText'=>$query,'busqueda_cliente'=>$busqueda_cliente,'nombre'=>'','lista'=>$lista,'pagos'=>$pagos,'historia'=>$historia]);   

      }
  
            $mytime=Carbon::now('America/Santiago');

          $lista= DB::table('efi_convenios_pago as c')
             ->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.codigo_usuario as int)'))
             ->select('c.id as id','c.rut as rut','c.idcliente_origen as idcliente','c.idcampania_origen as idcampania','c.nro_convenio as nro',DB::raw('CAST(c.fecha_convenio as date) as fecha_convenio'),'c.monto_convenio as monto_convenio','c.monto_cuotas as monto_cuotas','u.nombre as nombre','c.estado_auditado as estado','c.estado_tabla_a as estado_tabla_a','c.monto_deuda','c.monto_dcto','c.abono_inicial','c.total_cuotas','c.primer_vcto','c.tipo_ajuste','c.fecha_abono','c.fecha_vigente','c.fecha_roto','c.fecha_cancelado','c.codigo_usuario_autoriza','c.pagare','c.cuota_morosa_total','c.cuoton','c.fecha_actual','c.estado_tabla_a')
            ->whereRaw( 'LOWER(c.rut) like ?', array($query) );

 if ($request->get('busqueda_cliente') != null) {
    $lista=  $lista->where('c.idcliente_origen','=',$request->get('busqueda_cliente'));
 }

   $lista=  $lista->orderBy(DB::raw('CAST(c.nro_convenio as int)'),'desc')->limit(1)->get();   

 Log::info("Lista:".$lista);







$v['cuota_actual']='';
$v['cuotas_pagadas']='';
$v['fecha_proximo_pago']='';
$v['dias_mora']='';
$v['saldo_mora']='';
$v['cantidad_cuotas_morosas']='';
$v['montodeuda']='';

$v['cuotas_pagadas']='';
$v1['dire']='Sin Dirección'; 
$v0['email']='Sin email';
$v['nombre']='';
$v['dv']='';
$lista2='';
$sumasaldo_total='';
$estado_tabla_a='';


 if($query != '') {
$idcliente='0';
$nro='E';


  foreach ($lista as $rt) {
                $idcliente = $rt->idcliente; 
                $nro = $rt->nro; 
                $estado_tabla_a=$rt->estado_tabla_a;
            }    
             Log::info("ID del Cliente:".$idcliente);



// Buscar Pagos del Cliente

 $pagos = DB::table('j_base_pagos_eficaz')
              ->select(DB::raw('distinct monto,
                                to_char(fecha_pago::date, \'DD-MM-YYYY\') as fecha_pago2
                                ,fecha_pago::date'
                                ))
              ->where('rut',$query)
              ->where('idcliente',$idcliente)
              ->orderBy(DB::raw('fecha_pago::date'),'desc')
              ->get();
// Fin Buscar Pagos del Cliente

//Inicio Buscar Gestiones del Cliente
$historia = DB::table('gestion2 as g')
              ->select(DB::raw('distinct g.id,g.rut,
                                to_char(g.fecha::timestamp, \'DD-MM-YYYY hh24:mi:ss\')
                                        as fecha,
                                f.codarea, f.fono,
                                u.nombre, a.descripcion,
                                g.observacion'
                                ))
               ->leftjoin('usuario as u', 'u.id', '=','g.idusuario')
               ->leftjoin('fono as f', function ($join) {
                      $join->on('f.idcliente','=','g.idcliente')
                           ->on('f.idcampania','=','g.idcampania')
                           ->on('f.id','=','g.idfono');
                      })
              ->leftjoin('arbolniv as a', 'a.id', '=','g.idgestion')
              ->where('g.rut',$query)
              ->where('g.idcliente',$idcliente)
              ->where(DB::raw('g.fecha::date'),'>=',
                      DB::raw('now()::date - interval \'90 day\''))
              ->orderBy('g.id','desc')
              ->get();

//Fin Buscar Gestiones del Cliente


 if($nro != 'E') {
//----------------------------------------------------------------------CALCULAR PAGOS
DB::select("select efi_pagos_cuotas(:id,:id2,:id3)",['id'=>$idcliente,'id2'=>$query,'id3'=>$nro]);

$lista2= DB::table('efi_pagos_cuotas as c')
             ->select('c.id as id','c.estado as estado','c.monto as monto','c.saldo as saldo','c.fecha_vcto as fecha_vcto','c.vencida as vencida')
             ->orderBy('id','asc')->get();  

$sumasaldo = DB::select("SELECT sum(saldo::int) as sumita  FROM efi_pagos_cuotas WHERE estado=:id1 or estado=:id2 or estado=:id3 or estado=:id4",['id1' => 'POR PAGAR','id2'=>'ABONO POR PAGAR','id3' => 'MOROSA','id4' => 'ABONADA']);
$sumasaldo_total="0";

  foreach ($sumasaldo as $var_saldo)
      {    
        $sumasaldo_total= $var_saldo->sumita;

      }
}
//----------------------------------------------------------------------------------
  //----------------------------------------------------------------------------Extraer Direccion
 $results1 = DB::select("Select (trim(coalesce(direccion,'')) ||', Comuna: '||trim(coalesce(comuna,''))||', Ciudad: '||trim(coalesce(ciudad,''))||', Region: '||trim(coalesce(region,''))) as dire from efi_direcciones_general  where rut=:id  and estado_direccion='valido' limit 1", [ 'id' => $query]);
        $v1['dire']='Sin Dirección';   
        $arr1 = json_decode(json_encode($results1), true);
                foreach ($arr1 as $k1=>$v1){    
                        Log::info("Dire:".$v1['dire']); 
                        }
 //----------------------------------------------------------------------------Extraer Email
 $results0 = DB::select("select email from efi_email_cliente_rut where rut = :id and estado_email='valido' limit 1", [ 'id' => $query]);
        $v0['email']='Sin email';
        $arr0 = json_decode(json_encode($results0), true);
                foreach ($arr0 as $k0=>$v0){    
                        Log::info("email:".$v0['email']); 
                        }

//----------------------------------------------------------------------------Extraer Nombre
            //Buscamos el nombre del cliente PRESTO
            if($idcliente == '60'){

           

$id_campa = DB::select("SELECT a.id as id FROM campania a INNER JOIN base b ON b.idcliente = a.idcliente AND b.idcampania = a.id AND b.estado = TRUE WHERE a.idcliente = 60 AND a.nombre LIKE '%ompleta%' ORDER BY a.id DESC LIMIT 1");
  foreach ($id_campa as $var1)
      {
     //   echo $var1->id;
      }

 Log::info("ID Campania:".$var1->id);

  $tabla= sprintf("a%03d%03d001",60,$var1->id);
            $tabla=(string)$tabla;
            Log::info("Tabla A Presto:".$tabla);

    $results = DB::select("SELECT nombre,cuotas_pagadas,cuota_actual,dv,montodeuda,fecha_proximo_pago,saldo_mora,cantidad_cuotas_morosas,dias_mora FROM ".$tabla." WHERE rut = :id limit 1", [ 'id' => $query]);
        
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
            if($idcliente == '83'){
$id_campa = DB::select("SELECT a.id as id FROM campania a INNER JOIN base b ON b.idcliente = a.idcliente AND b.idcampania = a.id AND b.estado = TRUE WHERE a.idcliente = 83 AND a.nombre LIKE '%ompleta%' ORDER BY a.id DESC LIMIT 1");
  foreach ($id_campa as $var1)
      {
       //echo $var1->id;
      }

 Log::info("ID Campania:".$var1->id);

            $tabla= sprintf("a%03d%03d001",83,$var1->id);
            $tabla=(string)$tabla;
            Log::info("Tabla A Walmart:".$tabla);

    $results = DB::select("SELECT nombre,cuotas_pagadas,cuota_actual,dv,montodeuda,fecha_proximo_pago,saldo_mora,cantidad_cuotas_morosas,dias_mora FROM ".$tabla." WHERE rut = :id limit 1", [ 'id' =>$query]);
        
        $arr = json_decode(json_encode($results), true);
                foreach ($arr as $k=>$v){
                        Log::info($v['nombre']); 
                        }

            }




        //Buscamos el nombre del cliente EFICAZ
            if($idcliente == '84'){

$id_campa = DB::select("SELECT a.id as id FROM campania a INNER JOIN base b ON b.idcliente = a.idcliente AND b.idcampania = a.id AND b.estado = TRUE WHERE a.idcliente = 84 AND a.nombre LIKE '%ompleta%' ORDER BY a.id DESC LIMIT 1");
  foreach ($id_campa as $var1)
      {
      //  echo $var1->id;
      }
Log::info("ID Campania:".$var1->id);
            $tabla= sprintf("a%03d%03d001",84,$var1->id);
            $tabla=(string)$tabla;
            Log::info("Tabla A Eficaz:".$tabla);

    $results = DB::select("SELECT nombre,cuotas_pagadas,cuota_actual,dv,montodeuda,fecha_proximo_pago,saldo_mora,cantidad_cuotas_morosas,dias_mora FROM ".$tabla." WHERE rut = :id limit 1", [ 'id' => $query]);
        
        $arr = json_decode(json_encode($results), true);
                foreach ($arr as $k=>$v){
                        Log::info($v['nombre']); 
                        }

            }


            //Buscamos el nombre del cliente SANTANDER
            if($idcliente == '68'){

$id_campa = DB::select("SELECT a.id as id FROM campania a INNER JOIN base b ON b.idcliente = a.idcliente AND b.idcampania = a.id AND b.estado = TRUE WHERE a.idcliente = 68 AND a.nombre LIKE '%ompleta%' ORDER BY a.id DESC LIMIT 1");
  foreach ($id_campa as $var1)
      {
       // echo $var1->id;
      }
Log::info("ID Campania:".$var1->id);

            $tabla= sprintf("a%03d%03d001",68,$var1->id);
            $tabla=(string)$tabla;
            Log::info("Tabla A Presto:".$tabla);

    $results = DB::select("SELECT nombre,cuotas_pagadas,cuota_actual,dv,montodeuda,fecha_proximo_pago,saldo_mora,cantidad_cuotas_morosas,dias_mora FROM ".$tabla." WHERE rut = :id limit 1", [ 'id' => $query]);
        
        $arr = json_decode(json_encode($results), true);
                foreach ($arr as $k=>$v){
                        Log::info($v['nombre']); 
                        }

            }

           if ($v['cuota_actual'] == '') {$v['cuota_actual']='0';} 
           if ($v['cuotas_pagadas'] == '') {$v['cuotas_pagadas']='0';} 

if($nro=='E'){
   // return Redirect::to('/pagos')->with('status','El rut '.$query.', no posee ningún convenio Activo'); 

     return view('pagos.index',['status'=>'El rut '.$query.', no posee ningún convenio Activo','searchText'=>$query,'busqueda_cliente'=>'','nombre'=>'','lista'=>$lista,'pagos'=>$pagos,'historia'=>$historia]);


}

}//FIN DE if($query != '')

    if($v['montodeuda'] == '0'){
    // return Redirect::to('/pagos')->with('status','El cliente '.$v['nombre'].', ya ha pagado el total de su deuda');

      return view('pagos.index',['status'=>'El cliente '.$v['nombre'].', ya ha pagado el total de su deuda','busqueda_cliente'=>'','sumita'=>$sumasaldo_total,'lista'=>$lista,'lista2'=>$lista2,'searchText'=>$query,'nombre'=>$v['nombre'],'cuotas_pagadas'=>$v['cuotas_pagadas'],'cuota_actual'=>$v['cuota_actual'],'email'=>$v0['email'],'dire'=>$v1['dire'],'dv'=>$v['dv']
      ,'fecha_proximo_pago'=>$v['fecha_proximo_pago']
      ,'dias_mora'=>$v['dias_mora']
      ,'saldo_mora'=>$v['saldo_mora']
      ,'cantidad_cuotas_morosas'=>$v['cantidad_cuotas_morosas']
      ,'montodeuda'=>$v['montodeuda'],'pagos'=>$pagos,'historia'=>$historia
    ]);

    //  return view('pagos.index',['lista'=>$lista,'lista2'=>$lista2,'status'=>'El cliente ya ha pagado el total de su deuda','searchText'=>$query,'nombre'=>$v['nombre'],'email'=>$v0['email'],'dire'=>$v1['dire'],'dv'=>$v['dv'],'cuotas_pagadas'=>$v['cuotas_pagadas'],'cuota_actual'=>$v['cuota_actual']]);
    }
else{
    return view('pagos.index',['status'=>'','busqueda_cliente'=>'','sumita'=>$sumasaldo_total,'lista'=>$lista,'pagos'=>$pagos,'historia'=>$historia,'lista2'=>$lista2,'searchText'=>$query,'nombre'=>$v['nombre'],'cuotas_pagadas'=>$v['cuotas_pagadas'],'cuota_actual'=>$v['cuota_actual'],'email'=>$v0['email'],'dire'=>$v1['dire'],'dv'=>$v['dv']
      ,'fecha_proximo_pago'=>$v['fecha_proximo_pago']
      ,'dias_mora'=>$v['dias_mora']
      ,'saldo_mora'=>$v['saldo_mora']
      ,'cantidad_cuotas_morosas'=>$v['cantidad_cuotas_morosas']
      ,'montodeuda'=>$v['montodeuda']

  ]);
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

$ban="x";

         $ver= DB::table('efi_comprobante_pago as c')
             ->select('c.id as id')
            ->where(DB::raw('CAST(c.fecha_pago as date)'),'=',new DateTime($request->fecha_caja_buscar))->limit(1)->get();

              foreach ($ver as $rt) {
                $ban = $rt->id; 
            } 

            if ($ban != 'x'){

//PARA WALMART
          $wal= DB::table('efi_comprobante_pago as c')
             ->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.idusuario as int)'))
             ->select('c.id as id',DB::raw("(c.control || '-' || to_char(CAST(c.fecha_pago as date),'YYYY')) AS control"),'c.rut as rut','c.idcliente as idcliente','c.idcampania as idcampania','c.monto_pago as monto_pago','c.cuenta as cuenta','u.nombre as usuario','c.nombre','c.fecha_pago as fecha_pago','c.tipo_pago as tipo_pago','c.cierre','c.motivo_anular')
            ->where(DB::raw('CAST(c.fecha_pago as date)'),'=',new DateTime($request->fecha_caja_buscar))
            ->where('c.idcliente','=','83')
            ->orderBy('c.id','desc')
            ->get(); 
          
$sumawal = DB::select("SELECT sum(monto_pago::int) as control,cierre as cierre,tipo_pago as tipo_pago FROM efi_comprobante_pago WHERE fecha_pago::date =:id1 and idcliente =:id2 group by cierre,tipo_pago",['id1' => new DateTime($request->fecha_caja_buscar),'id2'=>'83']);

$tipo_wal_efectivo="0";
$tipo_wal_cheque="0";
$tipo_wal_vale="0";
$tipo_wal_tran="0";
$sumawal_total=0;
$sumawal_total2=0;
$cierrewal="0";

  foreach ($sumawal as $varx)
      {
        if($varx->tipo_pago == 'EFECTIVO')  {$tipo_wal_efectivo= $varx->control;}
        if($varx->tipo_pago == 'CHEQUE')  {$tipo_wal_cheque= $varx->control;}
        if($varx->tipo_pago == 'VALE VISTA')  {$tipo_wal_vale= $varx->control;}
        if($varx->tipo_pago == 'TRANSFERENCIA')  {$tipo_wal_tran= $varx->control;}
       
         if($varx->tipo_pago != 'TRANSFERENCIA') 
         {$sumawal_total2= $sumawal_total2 + $varx->control;}

        $sumawal_total= $sumawal_total + $varx->control;
        $cierrewal = $varx->cierre;
      }


//PARA EFICAZ
          $efi= DB::table('efi_comprobante_pago as c')
             ->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.idusuario as int)'))
             ->select('c.id as id',DB::raw("(c.control || '-' || to_char(CAST(c.fecha_pago as date),'YYYY')) AS control"),'c.rut as rut','c.idcliente as idcliente','c.idcampania as idcampania','c.monto_pago as monto_pago','c.cuenta as cuenta','u.nombre as usuario','c.nombre','c.fecha_pago as fecha_pago','c.tipo_pago as tipo_pago','c.cierre','c.motivo_anular')
            ->where(DB::raw('CAST(c.fecha_pago as date)'),'=',new DateTime($request->fecha_caja_buscar))
            ->where('c.idcliente','=','84')
            ->orderBy('c.id','desc')
            ->get(); 
$sumaefi = DB::select("SELECT sum(monto_pago::int) as control,cierre as cierre,tipo_pago as tipo_pago  FROM efi_comprobante_pago WHERE fecha_pago::date =:id1 and idcliente =:id2 group by cierre,tipo_pago",['id1' => new DateTime($request->fecha_caja_buscar),'id2'=>'84']);
$tipo_efi_efectivo="0";
$tipo_efi_cheque="0";
$tipo_efi_vale="0";
$tipo_efi_tran="0";
$sumaefi_total=0;
$sumaefi_total2=0;
$cierreefi="0";

  foreach ($sumaefi as $varx2)
      {
        if($varx2->tipo_pago == 'EFECTIVO')  {$tipo_efi_efectivo= $varx2->control;}
        if($varx2->tipo_pago == 'CHEQUE')  {$tipo_efi_cheque= $varx2->control;}
        if($varx2->tipo_pago == 'VALE VISTA')  {$tipo_efi_vale= $varx2->control;}
        if($varx2->tipo_pago == 'TRANSFERENCIA')  {$tipo_efi_tran= $varx2->control;}
       
        if($varx2->tipo_pago != 'TRANSFERENCIA') 
         {$sumaefi_total2= $sumaefi_total2 + $varx2->control;}
       
        $sumaefi_total= $sumaefi_total + $varx2->control;
        $cierreefi = $varx2->cierre;
      }
//PARA PRESTO
          $pre= DB::table('efi_comprobante_pago as c')
             ->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.idusuario as int)'))
             ->select('c.id as id',DB::raw("(c.control || '-' || to_char(CAST(c.fecha_pago as date),'YYYY')) AS control"),'c.rut as rut','c.idcliente as idcliente','c.idcampania as idcampania','c.monto_pago as monto_pago','c.cuenta as cuenta','u.nombre as usuario','c.nombre','c.fecha_pago as fecha_pago','c.tipo_pago as tipo_pago','c.cierre','c.motivo_anular')
            ->where(DB::raw('CAST(c.fecha_pago as date)'),'=',new DateTime($request->fecha_caja_buscar))
            ->where('c.idcliente','=','60')
            ->orderBy('c.id','desc')
            ->get(); 
$sumapre = DB::select("SELECT sum(monto_pago::int) as control,cierre as cierre,tipo_pago as tipo_pago FROM efi_comprobante_pago WHERE fecha_pago::date =:id1 and idcliente =:id2 group by cierre,tipo_pago",['id1' => new DateTime($request->fecha_caja_buscar),'id2'=>'60']);
$tipo_pre_efectivo="0";
$tipo_pre_cheque="0";
$tipo_pre_vale="0";
$tipo_pre_tran="0";
$sumapre_total=0;
$sumapre_total2=0;
$cierrepre="0";

  foreach ($sumapre as $varx3)
      {
        if($varx3->tipo_pago == 'EFECTIVO')  {$tipo_pre_efectivo= $varx3->control;}
        if($varx3->tipo_pago == 'CHEQUE')  {$tipo_pre_cheque= $varx3->control;}
        if($varx3->tipo_pago == 'VALE VISTA')  {$tipo_pre_vale= $varx3->control;}
        if($varx3->tipo_pago == 'TRANSFERENCIA')  {$tipo_pre_tran= $varx3->control;}
       
        if($varx3->tipo_pago != 'TRANSFERENCIA') 
         {$sumapre_total2= $sumapre_total2 + $varx3->control;}

        $sumapre_total= $sumapre_total + $varx3->control;
        $cierrepre = $varx3->cierre;
      }
//PARA SANTANDER
          $san= DB::table('efi_comprobante_pago as c')
             ->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.idusuario as int)'))
             ->select('c.id as id',DB::raw("(c.control || '-' || to_char(CAST(c.fecha_pago as date),'YYYY')) AS control"),'c.rut as rut','c.idcliente as idcliente','c.idcampania as idcampania','c.monto_pago as monto_pago','c.cuenta as cuenta','u.nombre as usuario','c.nombre','c.fecha_pago as fecha_pago','c.tipo_pago as tipo_pago','c.cierre','c.motivo_anular')
            ->where(DB::raw('CAST(c.fecha_pago as date)'),'=',new DateTime($request->fecha_caja_buscar))
            ->where('c.idcliente','=','68')
            ->orderBy('c.id','desc')
            ->get(); 
$sumasan = DB::select("SELECT sum(monto_pago::int) as control,cierre as cierre,tipo_pago as tipo_pago FROM efi_comprobante_pago WHERE fecha_pago::date =:id1 and idcliente =:id2 group by cierre,tipo_pago",['id1' => new DateTime($request->fecha_caja_buscar),'id2'=>'68']);
$tipo_san_efectivo="0";
$tipo_san_cheque="0";
$tipo_san_vale="0";
$tipo_san_tran="0";
$sumasan_total=0;
$sumasan_total2=0;
$cierresan="0";

  foreach ($sumasan as $varx4)
      {
        if($varx4->tipo_pago == 'EFECTIVO')  {$tipo_san_efectivo= $varx4->control;}
        if($varx4->tipo_pago == 'CHEQUE')  {$tipo_san_cheque= $varx4->control;}
        if($varx4->tipo_pago == 'VALE VISTA')  {$tipo_san_vale= $varx4->control;}
        if($varx4->tipo_pago == 'TRANSFERENCIA')  {$tipo_san_tran= $varx4->control;}

          if($varx4->tipo_pago != 'TRANSFERENCIA') 
         {$sumasan_total2= $sumasan_total2 + $varx4->control;}

        $sumasan_total= $sumasan_total + $varx4->control;
        $cierresan = $varx4->cierre;
      }

//REQUERIDO PARA LA PLANILLA A PARTIR DE AQUI
$contawal = DB::select("SELECT count(*) as contador FROM efi_comprobante_pago WHERE fecha_pago::date =:id1 and idcliente =:id2",['id1' => new DateTime($request->fecha_caja_buscar),'id2'=>'83']);
$contawal_1=0;
foreach ($contawal as $con1)
      {
        $contawal_1= $con1->contador;
      }
$contaefi= DB::select("SELECT count(*) as contador FROM efi_comprobante_pago WHERE fecha_pago::date =:id1 and idcliente =:id2",['id1' => new DateTime($request->fecha_caja_buscar),'id2'=>'84']);
$contaefi_1=0;
foreach ($contaefi as $con2)
      {
        $contaefi_1= $con2->contador;
      }
$contapre = DB::select("SELECT count(*) as contador FROM efi_comprobante_pago WHERE fecha_pago::date =:id1 and idcliente =:id2",['id1' => new DateTime($request->fecha_caja_buscar),'id2'=>'60']);
$contapre_1=0;
foreach ($contapre as $con3)
      {
        $contapre_1= $con3->contador;
      }
$contasan = DB::select("SELECT count(*) as contador FROM efi_comprobante_pago WHERE fecha_pago::date =:id1 and idcliente =:id2",['id1' => new DateTime($request->fecha_caja_buscar),'id2'=>'68']);
$contasan_1=0;
foreach ($contasan as $con4)
      {
        $contasan_1= $con4->contador;
      }

$limite_pre="B".(5+$contapre_1+1).":K".(5+$contapre_1+1);
$limite_san="B".(5+$contasan_1+1).":K".(5+$contasan_1+1);
$limite_efi="B".(5+$contaefi_1+1).":K".(5+$contaefi_1+1);
$limite_wal="B".(5+$contawal_1+1).":K".(5+$contawal_1+1);

if(isset($request) && $request->get('exp') == '1')
                {
$wal_pla= DB::table('efi_comprobante_pago as c')
             ->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.idusuario as int)'))
             ->select(DB::raw("(c.control || '-' || to_char(CAST(c.fecha_pago as date),'YYYY')) AS FOLIO"),'c.fecha_pago as FECHA','c.rut as RUT','c.dv as DV','c.nombre AS NOMBRE',DB::raw("(case when c.tipo_pago = 'EFECTIVO' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS EFECTIVO "),DB::raw("(case when c.tipo_pago = 'CHEQUE' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS CHEQUE "),DB::raw("(case when c.tipo_pago = 'VALE VISTA' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS VALE_VISTA "),DB::raw("(case when c.tipo_pago = 'TRANSFERENCIA' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS TRANSFERENCIA "),'u.nombre as CAJERO')
            ->where(DB::raw('CAST(c.fecha_pago as date)'),'=',new DateTime($request->fecha_caja_buscar))
            ->where('c.idcliente','=','83')
            ->orderBy('c.tipo_pago','desc')
            ->get(); 

 $pre_pla= DB::table('efi_comprobante_pago as c')
             ->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.idusuario as int)'))
             ->select(DB::raw("(c.control || '-' || to_char(CAST(c.fecha_pago as date),'YYYY')) AS FOLIO"),'c.fecha_pago as FECHA','c.rut as RUT','c.dv as DV','c.nombre AS NOMBRE',DB::raw("(case when c.tipo_pago = 'EFECTIVO' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS EFECTIVO "),DB::raw("(case when c.tipo_pago = 'CHEQUE' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS CHEQUE "),DB::raw("(case when c.tipo_pago = 'VALE VISTA' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS VALE_VISTA "),DB::raw("(case when c.tipo_pago = 'TRANSFERENCIA' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS TRANSFERENCIA "),'u.nombre as CAJERO')
            ->where(DB::raw('CAST(c.fecha_pago as date)'),'=',new DateTime($request->fecha_caja_buscar))
            ->where('c.idcliente','=','60')
            ->orderBy('c.tipo_pago','desc')
            ->get();  
 $san_pla= DB::table('efi_comprobante_pago as c')
             ->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.idusuario as int)'))
             ->select(DB::raw("(c.control || '-' || to_char(CAST(c.fecha_pago as date),'YYYY')) AS FOLIO"),'c.fecha_pago as FECHA','c.rut as RUT','c.dv as DV','c.nombre AS NOMBRE',DB::raw("(case when c.tipo_pago = 'EFECTIVO' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS EFECTIVO "),DB::raw("(case when c.tipo_pago = 'CHEQUE' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS CHEQUE "),DB::raw("(case when c.tipo_pago = 'VALE VISTA' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS VALE_VISTA "),DB::raw("(case when c.tipo_pago = 'TRANSFERENCIA' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS TRANSFERENCIA "),'u.nombre as CAJERO')
            ->where(DB::raw('CAST(c.fecha_pago as date)'),'=',new DateTime($request->fecha_caja_buscar))
            ->where('c.idcliente','=','68')
            ->orderBy('c.tipo_pago','desc')
            ->get(); 
 $efi_pla= DB::table('efi_comprobante_pago as c')
             ->join('usuario as u', 'u.id', '=',DB::raw('CAST(c.idusuario as int)'))
             ->select(DB::raw("(c.control || '-' || to_char(CAST(c.fecha_pago as date),'YYYY')) AS FOLIO"),'c.fecha_pago as FECHA','c.rut as RUT','c.dv as DV','c.nombre AS NOMBRE',DB::raw("(case when c.tipo_pago = 'EFECTIVO' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS EFECTIVO "),DB::raw("(case when c.tipo_pago = 'CHEQUE' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS CHEQUE "),DB::raw("(case when c.tipo_pago = 'VALE VISTA' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS VALE_VISTA "),DB::raw("(case when c.tipo_pago = 'TRANSFERENCIA' THEN replace(to_char(CAST(c.monto_pago as int),'$99,999,999'),',','.') END) AS TRANSFERENCIA "),'u.nombre as CAJERO')
            ->where(DB::raw('CAST(c.fecha_pago as date)'),'=',new DateTime($request->fecha_caja_buscar))
            ->where('c.idcliente','=','84')
            ->orderBy('c.tipo_pago','desc')
            ->get(); 

       
       $efi2 = json_decode(json_encode($efi_pla), true);
       $wal2 = json_decode(json_encode($wal_pla), true);
       $pre2 = json_decode(json_encode($pre_pla), true);
       $san2 = json_decode(json_encode($san_pla), true);

       $fecha_reporte=$request->fecha_caja_buscar;

Excel::create('Caja_Deposito_Fecha_'.$fecha_reporte, function($excel) use($sumawal_total,$sumapre_total,$sumasan_total,$sumaefi_total,$efi2,$wal2,$pre2,$san2,$fecha_reporte,$limite_pre,$limite_san,$limite_efi,$limite_wal,$contapre_1,$contasan_1,$contaefi_1,$contawal_1,$tipo_pre_efectivo,$tipo_pre_tran,$tipo_pre_vale,$tipo_pre_cheque,$tipo_san_efectivo,$tipo_san_tran,$tipo_san_vale,$tipo_san_cheque,$tipo_wal_efectivo,$tipo_wal_tran,$tipo_wal_vale,$tipo_wal_cheque,$tipo_efi_efectivo,$tipo_efi_tran,$tipo_efi_vale,$tipo_efi_cheque) {


    $excel->sheet('CXC', function($sheet) use($efi2,$fecha_reporte,$sumaefi_total,$limite_efi,$contaefi_1,$tipo_efi_efectivo,$tipo_efi_tran,$tipo_efi_vale,$tipo_efi_cheque) {

         $sheet->row(1, array('','','','','','','','','EFICAZ SA',$fecha_reporte));
         $sheet->row(3, array('','','','','RECAUDACION DIARIA EFICAZ CXC'));
         $sheet->row(5, array('','FOLIO','FECHA DE PAGO','RUT','DV','NOMBRE','EFECTIVO','CHEQUE','VALE VISTA','TRANSFERENCIA','CAJERO'));
         $sheet->setWidth('A', 1);
         $sheet->setWidth('B', 12);
         $sheet->setWidth('C', 20);
         $sheet->setWidth('D', 12);
         $sheet->setWidth('E', 5);
         $sheet->setWidth('F', 50);
         $sheet->setWidth('G', 11);
         $sheet->setWidth('H', 11);
         $sheet->setWidth('I', 11);
         $sheet->setWidth('J', 19);
         $sheet->setWidth('K', 20);

         $sheet->fromArray($efi2, null,'B6',false,false);

  if ($contaefi_1 == 0){
    $sheet->row(6, array('','','','','','DEPOSITAR EN BANCO DE CHILE: CTA 512169-08','$    '.number_format($sumaefi_total, 0, ",", "."),'$    '.number_format($sumaefi_total, 0, ",", "."),'$    '.number_format($sumaefi_total, 0, ",", "."),'$    '.number_format($sumaefi_total, 0, ",", ".")));
  }else{
    $sheet->appendRow(array('','','','','','DEPOSITAR EN BANCO DE CHILE: CTA 512169-08','$    '.number_format($tipo_efi_efectivo, 0, ",", "."),'$    '.number_format($tipo_efi_cheque, 0, ",", "."),'$    '.number_format($tipo_efi_vale, 0, ",", "."),'$    '.number_format($tipo_efi_tran, 0, ",", "."),'TOTAL: $ '.number_format($sumaefi_total, 0, ",", ".")));
    /*$sheet->appendRow(array('','','','','RECAUDACION TOTAL','$    '.number_format($sumaefi_total2, 0, ",", ".")));*/
  }
        
         $sheet->appendRow(array(''));
         $sheet->appendRow(array(''));

        $sheet->cells('G1:K1', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                $cell->setFontSize(18);
          });

         $sheet->cell('E3', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                $cell->setFontSize(22);
          });

          $sheet->cells('B5:K5', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                // Set black background
                $cell->setBackground('#C433FF');
               // $cell->setFontSize(22);
          });
            $sheet->cells($limite_efi, function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                // Set black background
                $cell->setBackground('#EEC8DD');
               // $cell->setFontSize(22);
          });

        // Set border for range
        $sheet->row(21, array('','DETALLE DE RECUPERO','','','','','','','DETALLE DE CAJA CHICA'));
        $sheet->cell('B21', function($cell) {
                $cell->setFontWeight('bold');
          });
        $sheet->cell('I21', function($cell) {
                $cell->setFontWeight('bold');
          });

        $sheet->setBorder('B5:K20', 'thin');  //CONTENIDO TABLA
        $sheet->setBorder('B22:C35', 'thin'); //MONEDAS

            $sheet->cell('B22', function($cell) {
                $cell->setValue('BILLETES');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('B23', function($cell) {
                $cell->setValue('20000');
          });
            $sheet->cell('B24', function($cell) {
                $cell->setValue('10000');
          });
            $sheet->cell('B25', function($cell) {
                $cell->setValue('5000');
          });
            $sheet->cell('B26', function($cell) {
                $cell->setValue('2000');
          });
            $sheet->cell('B27', function($cell) {
                $cell->setValue('1000');
          });
            $sheet->cell('B28', function($cell) {
                $cell->setValue('MONEDAS');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('B29', function($cell) {
                $cell->setValue('500');
          });
            $sheet->cell('B30', function($cell) {
                $cell->setValue('100');
          });
            $sheet->cell('B31', function($cell) {
                $cell->setValue('50');
          });
            $sheet->cell('B32', function($cell) {
                $cell->setValue('10');
          });
            $sheet->cell('B33', function($cell) {
                $cell->setValue('5');
          });
            $sheet->cell('B34', function($cell) {
                $cell->setValue('1');
          });
            $sheet->cell('B35', function($cell) {
                $cell->setValue('TOTAL');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('C35', function($cell) {
                $cell->setFontWeight('bold');
          });
            $sheet->setCellValue('C35','=SUM(C23:C34)');
               $sheet->setColumnFormat(array(
            'C35' => '"$ "#,##0_-',
             'C23' => '"$ "#,##0_-',
              'C24' => '"$ "#,##0_-',
               'C25' => '"$ "#,##0_-',
                'C26' => '"$ "#,##0_-',
                 'C27' => '"$ "#,##0_-',
                  'C29' => '"$ "#,##0_-',
                   'C30' => '"$ "#,##0_-',
                    'C31' => '"$ "#,##0_-',
                     'C32' => '"$ "#,##0_-',
                      'C33' => '"$ "#,##0_-',
                       'C34' => '"$ "#,##0_-',
            ));


        // Set border for range TABLA DE LA DERECHA
        $sheet->setBorder('B5:K20', 'thin');  //CONTENIDO TABLA

        $sheet->setBorder('I22:J35', 'thin'); //MONEDAS

            $sheet->cell('I22', function($cell) {
                $cell->setValue('BILLETES');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('I23', function($cell) {
                $cell->setValue('20000');
          });
            $sheet->cell('I24', function($cell) {
                $cell->setValue('10000');
          });
            $sheet->cell('I25', function($cell) {
                $cell->setValue('5000');
          });
            $sheet->cell('I26', function($cell) {
                $cell->setValue('2000');
          });
            $sheet->cell('I27', function($cell) {
                $cell->setValue('1000');
          });
            $sheet->cell('I28', function($cell) {
                $cell->setValue('MONEDAS');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('I29', function($cell) {
                $cell->setValue('500');
          });
            $sheet->cell('I30', function($cell) {
                $cell->setValue('100');
          });
            $sheet->cell('I31', function($cell) {
                $cell->setValue('50');
          });
            $sheet->cell('I32', function($cell) {
                $cell->setValue('10');
          });
            $sheet->cell('I33', function($cell) {
                $cell->setValue('5');
          });
            $sheet->cell('I34', function($cell) {
                $cell->setValue('1');
          });
            $sheet->cell('I35', function($cell) {
                $cell->setValue('TOTAL');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('J35', function($cell) {
                $cell->setFontWeight('bold');
          });
            $sheet->setCellValue('J35','=SUM(J23:J34)');
                $sheet->setColumnFormat(array(
            'J35' => '"$ "#,##0_-',
             'J23' => '"$ "#,##0_-',
              'J24' => '"$ "#,##0_-',
               'J25' => '"$ "#,##0_-',
                'J26' => '"$ "#,##0_-',
                 'J27' => '"$ "#,##0_-',
                  'J29' => '"$ "#,##0_-',
                   'J30' => '"$ "#,##0_-',
                    'J31' => '"$ "#,##0_-',
                     'J32' => '"$ "#,##0_-',
                      'J33' => '"$ "#,##0_-',
                       'J34' => '"$ "#,##0_-',
            ));

$sheet->row(36, array('','','','','','________________________                   ______________________'));
$sheet->row(37, array('','','','','','        RECIBI CONFORME                                           HECHO POR'));
      /*  $sheet->rows(array(
                array('','','BILLETES'),
                 array('','','20.000'),
                  array('','','10.000'),
                   array('','','5.000'),
                    array('','','2.000'),
                     array('','','1.000'),
                      array('','','Monedas'),
                       array('','','500'),
                        array('','','100'),
                         array('','','50'),
                          array('','','5'),
                           array('','','1'),
                            array('','','TOTAL')
                ));*/
        
  
    });

    $excel->sheet('WALMART', function($sheet) use($wal2,$fecha_reporte,$sumawal_total,$limite_wal,$contawal_1,$tipo_wal_efectivo,$tipo_wal_tran,$tipo_wal_vale,$tipo_wal_cheque) {
         
         $sheet->row(1, array('','','','','','','','','EFICAZ SA',$fecha_reporte));
         $sheet->row(3, array('','','','','RECAUDACION DIARIA WALMART'));
        $sheet->row(5, array('','FOLIO','FECHA DE PAGO','RUT','DV','NOMBRE','EFECTIVO','CHEQUE','VALE VISTA','TRANSFERENCIA','CAJERO'));
         
         $sheet->setWidth('A', 1);
         $sheet->setWidth('B', 12);
         $sheet->setWidth('C', 20);
         $sheet->setWidth('D', 12);
         $sheet->setWidth('E', 5);
         $sheet->setWidth('F', 50);
         $sheet->setWidth('G', 11);
         $sheet->setWidth('H', 11);
         $sheet->setWidth('I', 11);
         $sheet->setWidth('J', 19);
         $sheet->setWidth('K', 20);

         $sheet->fromArray($wal2, null, 'B6', false,false);

           if ($contawal_1 == 0){
    $sheet->row(6, array('','','','','','DEPOSITAR EN BANCO SANTANDER CTA. 6997725-1','$    '.number_format($sumawal_total, 0, ",", "."),'$    '.number_format($sumawal_total, 0, ",", "."),'$    '.number_format($sumawal_total, 0, ",", "."),'$    '.number_format($sumawal_total, 0, ",", ".")));
  }else{
     $sheet->appendRow(array('','','','','','DEPOSITAR EN BANCO SANTANDER CTA. 6997725-1','$    '.number_format($tipo_wal_efectivo, 0, ",", "."),'$    '.number_format($tipo_wal_cheque, 0, ",", "."),'$    '.number_format($tipo_wal_vale, 0, ",", "."),'$    '.number_format($tipo_wal_tran, 0, ",", "."),'TOTAL: $ '.number_format($sumawal_total, 0, ",", ".")));

       /*  $sheet->appendRow(array('','','','','RECAUDACION TOTAL','$    '.number_format($sumawal_total2, 0, ",", ".")));*/
     }
         $sheet->appendRow(array(''));
         $sheet->appendRow(array(''));

        $sheet->cells('G1:K1', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                $cell->setFontSize(18);
          });

         $sheet->cell('E3', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                $cell->setFontSize(22);
          });

          $sheet->cells('B5:K5', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                // Set black background
                $cell->setBackground('#28E64B');
               // $cell->setFontSize(22);
          });
         $sheet->cells($limite_wal, function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                // Set black background
                $cell->setBackground('#C8EEC8');
               // $cell->setFontSize(22);
          });
        // Set border for range
          $sheet->row(21, array('','DETALLE DE RECUPERO','','','','','','','DETALLE DE CAJA CHICA'));
        $sheet->cell('B21', function($cell) {
                $cell->setFontWeight('bold');
          });
        $sheet->cell('I21', function($cell) {
                $cell->setFontWeight('bold');
          });

        $sheet->setBorder('B5:K20', 'thin');  //CONTENIDO TABLA
        $sheet->setBorder('B22:C35', 'thin'); //MONEDAS

            $sheet->cell('B22', function($cell) {
                $cell->setValue('BILLETES');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('B23', function($cell) {
                $cell->setValue('20000');
          });
            $sheet->cell('B24', function($cell) {
                $cell->setValue('10000');
          });
            $sheet->cell('B25', function($cell) {
                $cell->setValue('5000');
          });
            $sheet->cell('B26', function($cell) {
                $cell->setValue('2000');
          });
            $sheet->cell('B27', function($cell) {
                $cell->setValue('1000');
          });
            $sheet->cell('B28', function($cell) {
                $cell->setValue('MONEDAS');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('B29', function($cell) {
                $cell->setValue('500');
          });
            $sheet->cell('B30', function($cell) {
                $cell->setValue('100');
          });
            $sheet->cell('B31', function($cell) {
                $cell->setValue('50');
          });
            $sheet->cell('B32', function($cell) {
                $cell->setValue('10');
          });
            $sheet->cell('B33', function($cell) {
                $cell->setValue('5');
          });
            $sheet->cell('B34', function($cell) {
                $cell->setValue('1');
          });
            $sheet->cell('B35', function($cell) {
                $cell->setValue('TOTAL');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('C35', function($cell) {
                $cell->setFontWeight('bold');
          });
            $sheet->setCellValue('C35','=SUM(C23:C34)');
              $sheet->setColumnFormat(array(
            'C35' => '"$ "#,##0_-',
             'C23' => '"$ "#,##0_-',
              'C24' => '"$ "#,##0_-',
               'C25' => '"$ "#,##0_-',
                'C26' => '"$ "#,##0_-',
                 'C27' => '"$ "#,##0_-',
                  'C29' => '"$ "#,##0_-',
                   'C30' => '"$ "#,##0_-',
                    'C31' => '"$ "#,##0_-',
                     'C32' => '"$ "#,##0_-',
                      'C33' => '"$ "#,##0_-',
                       'C34' => '"$ "#,##0_-',
            ));

 // Set border for range TABLA DE LA DERECHA
        $sheet->setBorder('B5:K20', 'thin');  //CONTENIDO TABLA

        $sheet->setBorder('I22:J35', 'thin'); //MONEDAS

            $sheet->cell('I22', function($cell) {
                $cell->setValue('BILLETES');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('I23', function($cell) {
                $cell->setValue('20000');
          });
            $sheet->cell('I24', function($cell) {
                $cell->setValue('10000');
          });
            $sheet->cell('I25', function($cell) {
                $cell->setValue('5000');
          });
            $sheet->cell('I26', function($cell) {
                $cell->setValue('2000');
          });
            $sheet->cell('I27', function($cell) {
                $cell->setValue('1000');
          });
            $sheet->cell('I28', function($cell) {
                $cell->setValue('MONEDAS');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('I29', function($cell) {
                $cell->setValue('500');
          });
            $sheet->cell('I30', function($cell) {
                $cell->setValue('100');
          });
            $sheet->cell('I31', function($cell) {
                $cell->setValue('50');
          });
            $sheet->cell('I32', function($cell) {
                $cell->setValue('10');
          });
            $sheet->cell('I33', function($cell) {
                $cell->setValue('5');
          });
            $sheet->cell('I34', function($cell) {
                $cell->setValue('1');
          });
            $sheet->cell('I35', function($cell) {
                $cell->setValue('TOTAL');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('J35', function($cell) {
                $cell->setFontWeight('bold');
          });
            $sheet->setCellValue('J35','=SUM(J23:J34)');
                $sheet->setColumnFormat(array(
            'J35' => '"$ "#,##0_-',
             'J23' => '"$ "#,##0_-',
              'J24' => '"$ "#,##0_-',
               'J25' => '"$ "#,##0_-',
                'J26' => '"$ "#,##0_-',
                 'J27' => '"$ "#,##0_-',
                  'J29' => '"$ "#,##0_-',
                   'J30' => '"$ "#,##0_-',
                    'J31' => '"$ "#,##0_-',
                     'J32' => '"$ "#,##0_-',
                      'J33' => '"$ "#,##0_-',
                       'J34' => '"$ "#,##0_-',
            ));

$sheet->row(36, array('','','','','','________________________                   ______________________'));
$sheet->row(37, array('','','','','','        RECIBI CONFORME                                           HECHO POR'));

    });

    $excel->sheet('SANTANDER', function($sheet) use($san2,$fecha_reporte,$sumasan_total,$limite_san,$contasan_1,$tipo_san_efectivo,$tipo_san_tran,$tipo_san_vale,$tipo_san_cheque) {
         
         $sheet->row(1, array('','','','','','','','','EFICAZ SA',$fecha_reporte));
         $sheet->row(3, array('','','','','RECAUDACION DIARIA SANTANDER'));
         $sheet->row(5, array('','FOLIO','FECHA DE PAGO','RUT','DV','NOMBRE','EFECTIVO','CHEQUE','VALE VISTA','TRANSFERENCIA','CAJERO'));
        
         $sheet->setWidth('A', 1);
         $sheet->setWidth('B', 12);
         $sheet->setWidth('C', 20);
         $sheet->setWidth('D', 12);
         $sheet->setWidth('E', 5);
         $sheet->setWidth('F', 50);
         $sheet->setWidth('G', 11);
         $sheet->setWidth('H', 11);
         $sheet->setWidth('I', 11);
         $sheet->setWidth('J', 19);
         $sheet->setWidth('K', 20);

         $sheet->fromArray($san2, null, 'B6', false,false);

          if ($contasan_1 == 0){
    $sheet->row(6, array('','','','','','DEPOSITAR EN BANCO SANTANDER CTA 6796105-6','$    '.number_format($sumasan_total, 0, ",", "."),'$    '.number_format($sumasan_total, 0, ",", "."),'$    '.number_format($sumasan_total, 0, ",", "."),'$    '.number_format($sumasan_total, 0, ",", ".")));
  }else{
     $sheet->appendRow(array('','','','','','DEPOSITAR EN BANCO SANTANDER CTA 6796105-6','$    '.number_format($tipo_san_efectivo, 0, ",", "."),'$    '.number_format($tipo_san_cheque, 0, ",", "."),'$    '.number_format($tipo_san_vale, 0, ",", "."),'$    '.number_format($tipo_san_tran, 0, ",", "."),'TOTAL: $ '.number_format($sumasan_total, 0, ",", ".")));
        /* $sheet->appendRow(array('','','','','RECAUDACION TOTAL','$    '.number_format($sumasan_total2, 0, ",", ".")));*/
     }
         $sheet->appendRow(array(''));
         $sheet->appendRow(array(''));

        $sheet->cells('G1:K1', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                $cell->setFontSize(18);
          });

         $sheet->cell('E3', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                $cell->setFontSize(22);
          });

          $sheet->cells('B5:K5', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                // Set black background
                $cell->setBackground('#FF3633');
               // $cell->setFontSize(22);
          });
        $sheet->cells($limite_san, function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                // Set black background
                $cell->setBackground('#FC9694');
               // $cell->setFontSize(22);
          });
        // Set border for range
         $sheet->row(21, array('','DETALLE DE RECUPERO','','','','','','','DETALLE DE CAJA CHICA'));
        $sheet->cell('B21', function($cell) {
                $cell->setFontWeight('bold');
          });
        $sheet->cell('I21', function($cell) {
                $cell->setFontWeight('bold');
          });

        $sheet->setBorder('B5:K20', 'thin');  //CONTENIDO TABLA
        $sheet->setBorder('B22:C35', 'thin'); //MONEDAS

            $sheet->cell('B22', function($cell) {
                $cell->setValue('BILLETES');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('B23', function($cell) {
                $cell->setValue('20000');
          });
            $sheet->cell('B24', function($cell) {
                $cell->setValue('10000');
          });
            $sheet->cell('B25', function($cell) {
                $cell->setValue('5000');
          });
            $sheet->cell('B26', function($cell) {
                $cell->setValue('2000');
          });
            $sheet->cell('B27', function($cell) {
                $cell->setValue('1000');
          });
            $sheet->cell('B28', function($cell) {
                $cell->setValue('MONEDAS');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('B29', function($cell) {
                $cell->setValue('500');
          });
            $sheet->cell('B30', function($cell) {
                $cell->setValue('100');
          });
            $sheet->cell('B31', function($cell) {
                $cell->setValue('50');
          });
          $sheet->cell('B32', function($cell) {
                $cell->setValue('10');
          });
            $sheet->cell('B33', function($cell) {
                $cell->setValue('5');
          });
            $sheet->cell('B34', function($cell) {
                $cell->setValue('1');
          });
            $sheet->cell('B35', function($cell) {
                $cell->setValue('TOTAL');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('C35', function($cell) {
                $cell->setFontWeight('bold');
          });   
            $sheet->setCellValue('C35','=SUM(C23:C34)');

              $sheet->setColumnFormat(array(
            'C35' => '"$ "#,##0_-',
             'C23' => '"$ "#,##0_-',
              'C24' => '"$ "#,##0_-',
               'C25' => '"$ "#,##0_-',
                'C26' => '"$ "#,##0_-',
                 'C27' => '"$ "#,##0_-',
                  'C29' => '"$ "#,##0_-',
                   'C30' => '"$ "#,##0_-',
                    'C31' => '"$ "#,##0_-',
                     'C32' => '"$ "#,##0_-',
                      'C33' => '"$ "#,##0_-',
                       'C34' => '"$ "#,##0_-',
            ));

 // Set border for range TABLA DE LA DERECHA
        $sheet->setBorder('B5:K20', 'thin');  //CONTENIDO TABLA

        $sheet->setBorder('I22:J35', 'thin'); //MONEDAS

            $sheet->cell('I22', function($cell) {
                $cell->setValue('BILLETES');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('I23', function($cell) {
                $cell->setValue('20000');
          });
            $sheet->cell('I24', function($cell) {
                $cell->setValue('10000');
          });
            $sheet->cell('I25', function($cell) {
                $cell->setValue('5000');
          });
            $sheet->cell('I26', function($cell) {
                $cell->setValue('2000');
          });
            $sheet->cell('I27', function($cell) {
                $cell->setValue('1000');
          });
            $sheet->cell('I28', function($cell) {
                $cell->setValue('MONEDAS');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('I29', function($cell) {
                $cell->setValue('500');
          });
            $sheet->cell('I30', function($cell) {
                $cell->setValue('100');
          });
            $sheet->cell('I31', function($cell) {
                $cell->setValue('50');
          });
            $sheet->cell('I32', function($cell) {
                $cell->setValue('10');
          });
            $sheet->cell('I33', function($cell) {
                $cell->setValue('5');
          });
            $sheet->cell('I34', function($cell) {
                $cell->setValue('1');
          });
            $sheet->cell('I35', function($cell) {
                $cell->setValue('TOTAL');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('J35', function($cell) {
                $cell->setFontWeight('bold');
          });
            $sheet->setCellValue('J35','=SUM(J23:J34)');
              $sheet->setColumnFormat(array(
            'J35' => '"$ "#,##0_-',
             'J23' => '"$ "#,##0_-',
              'J24' => '"$ "#,##0_-',
               'J25' => '"$ "#,##0_-',
                'J26' => '"$ "#,##0_-',
                 'J27' => '"$ "#,##0_-',
                  'J29' => '"$ "#,##0_-',
                   'J30' => '"$ "#,##0_-',
                    'J31' => '"$ "#,##0_-',
                     'J32' => '"$ "#,##0_-',
                      'J33' => '"$ "#,##0_-',
                       'J34' => '"$ "#,##0_-',
            ));

$sheet->row(36, array('','','','','','________________________                   ______________________'));
$sheet->row(37, array('','','','','','        RECIBI CONFORME                                           HECHO POR'));


    });

    $excel->sheet('PRESTO', function($sheet) use($pre2,$fecha_reporte,$sumapre_total,$limite_pre,$contapre_1,$tipo_pre_efectivo,$tipo_pre_tran,$tipo_pre_vale,$tipo_pre_cheque) {
         
         $sheet->row(1, array('','','','','','','','','EFICAZ SA',$fecha_reporte));
         $sheet->row(3, array('','','','','RECAUDACION DIARIA PRESTO'));
         $sheet->row(5, array('','FOLIO','FECHA DE PAGO','RUT','DV','NOMBRE','EFECTIVO','CHEQUE','VALE VISTA','TRANSFERENCIA','CAJERO'));
         $sheet->setWidth('A', 1);
         $sheet->setWidth('B', 12);
         $sheet->setWidth('C', 20);
         $sheet->setWidth('D', 12);
         $sheet->setWidth('E', 5);
         $sheet->setWidth('F', 50);
         $sheet->setWidth('G', 11);
         $sheet->setWidth('H', 11);
         $sheet->setWidth('I', 11);
         $sheet->setWidth('J', 19);
         $sheet->setWidth('K', 20);

         $sheet->fromArray($pre2, null, 'B6', false,false);
         if ($contapre_1 == 0){
    $sheet->row(6, array('','','','','','DEPOSITAR EN BANCO SCOTIABANK CTA 0164-0100001325','$    '.number_format($sumapre_total, 0, ",", "."),'$    '.number_format($sumapre_total, 0, ",", "."),'$    '.number_format($sumapre_total, 0, ",", "."),'$    '.number_format($sumapre_total, 0, ",", ".")));
  }else{
     $sheet->appendRow(array('','','','','','DEPOSITAR EN BANCO SCOTIABANK CTA 0164-0100001325','$    '.number_format($tipo_pre_efectivo, 0, ",", "."),'$    '.number_format($tipo_pre_cheque, 0, ",", "."),'$    '.number_format($tipo_pre_vale, 0, ",", "."),'$    '.number_format($tipo_pre_tran, 0, ",", "."),'TOTAL: $ '.number_format($sumapre_total, 0, ",", ".")));
/*
         $sheet->appendRow(array('','','','','RECAUDACION TOTAL','$    '.number_format($sumapre_total, 0, ",", ".")));*/
     }
         $sheet->appendRow(array(''));
         $sheet->appendRow(array(''));

        $sheet->cells('G1:K1', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                $cell->setFontSize(18);
          });

         $sheet->cell('E3', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                $cell->setFontSize(22);
          });

          $sheet->cells('B5:K5', function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                // Set black background
                $cell->setBackground('#3336FF');
               // $cell->setFontSize(22);
          });
        $sheet->cells($limite_pre, function($cell) {
                // manipulate the cell
               // $cell->setValue('data1');
                $cell->setFontWeight('bold');
                // Set black background
                $cell->setBackground('#94E5FC');
               // $cell->setFontSize(22);
          });
        // Set border for range
         $sheet->row(21, array('','DETALLE DE RECUPERO','','','','','','','DETALLE DE CAJA CHICA'));
        $sheet->cell('B21', function($cell) {
                $cell->setFontWeight('bold');
          });
        $sheet->cell('I21', function($cell) {
                $cell->setFontWeight('bold');
          });
        $sheet->setBorder('B5:K20', 'thin');  //CONTENIDO TABLA
        $sheet->setBorder('B22:C35', 'thin'); //MONEDAS

            $sheet->cell('B22', function($cell) {
                $cell->setValue('BILLETES');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('B23', function($cell) {
                $cell->setValue('20000');
          });
            $sheet->cell('B24', function($cell) {
                $cell->setValue('10000');
          });
            $sheet->cell('B25', function($cell) {
                $cell->setValue('5000');
          });
            $sheet->cell('B26', function($cell) {
                $cell->setValue('2000');
          });
            $sheet->cell('B27', function($cell) {
                $cell->setValue('1000');
          });
            $sheet->cell('B28', function($cell) {
                $cell->setValue('MONEDAS');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('B29', function($cell) {
                $cell->setValue('500');
          });
            $sheet->cell('B30', function($cell) {
                $cell->setValue('100');
          });
            $sheet->cell('B31', function($cell) {
                $cell->setValue('50');
          });
            $sheet->cell('B32', function($cell) {
                $cell->setValue('10');
          });
            $sheet->cell('B33', function($cell) {
                $cell->setValue('5');
          });
            $sheet->cell('B34', function($cell) {
                $cell->setValue('1');
          });
            $sheet->cell('B35', function($cell) {
                $cell->setValue('TOTAL');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('C35', function($cell) {
                $cell->setFontWeight('bold');
          });
            $sheet->setCellValue('C35','=SUM(C23:C34)');
               $sheet->setColumnFormat(array(
            'C35' => '"$ "#,##0_-',
             'C23' => '"$ "#,##0_-',
              'C24' => '"$ "#,##0_-',
               'C25' => '"$ "#,##0_-',
                'C26' => '"$ "#,##0_-',
                 'C27' => '"$ "#,##0_-',
                  'C29' => '"$ "#,##0_-',
                   'C30' => '"$ "#,##0_-',
                    'C31' => '"$ "#,##0_-',
                     'C32' => '"$ "#,##0_-',
                      'C33' => '"$ "#,##0_-',
                       'C34' => '"$ "#,##0_-',
            ));

 // Set border for range TABLA DE LA DERECHA
        $sheet->setBorder('B5:K20', 'thin');  //CONTENIDO TABLA

        $sheet->setBorder('I22:J35', 'thin'); //MONEDAS

            $sheet->cell('I22', function($cell) {
                $cell->setValue('BILLETES');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('I23', function($cell) {
                $cell->setValue('20000');
          });
            $sheet->cell('I24', function($cell) {
                $cell->setValue('10000');
          });
            $sheet->cell('I25', function($cell) {
                $cell->setValue('5000');
          });
            $sheet->cell('I26', function($cell) {
                $cell->setValue('2000');
          });
            $sheet->cell('I27', function($cell) {
                $cell->setValue('1000');
          });
            $sheet->cell('I28', function($cell) {
                $cell->setValue('MONEDAS');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('I29', function($cell) {
                $cell->setValue('500');
          });
            $sheet->cell('I30', function($cell) {
                $cell->setValue('100');
          });
            $sheet->cell('I31', function($cell) {
                $cell->setValue('50');
          });
            $sheet->cell('I32', function($cell) {
                $cell->setValue('10');
          });
            $sheet->cell('I33', function($cell) {
                $cell->setValue('5');
          });
            $sheet->cell('I34', function($cell) {
                $cell->setValue('1');
          });
            $sheet->cell('I35', function($cell) {
                $cell->setValue('TOTAL');
                $cell->setFontWeight('bold');
          });
            $sheet->cell('J35', function($cell) {
                $cell->setFontWeight('bold');
          });
            $sheet->setCellValue('J35','=SUM(J23:J34)');
            $sheet->setColumnFormat(array(
            'J35' => '"$ "#,##0_-',
             'J23' => '"$ "#,##0_-',
              'J24' => '"$ "#,##0_-',
               'J25' => '"$ "#,##0_-',
                'J26' => '"$ "#,##0_-',
                 'J27' => '"$ "#,##0_-',
                  'J29' => '"$ "#,##0_-',
                   'J30' => '"$ "#,##0_-',
                    'J31' => '"$ "#,##0_-',
                     'J32' => '"$ "#,##0_-',
                      'J33' => '"$ "#,##0_-',
                       'J34' => '"$ "#,##0_-',
            ));

$sheet->row(36, array('','','','','','________________________                   ______________________'));
$sheet->row(37, array('','','','','','        RECIBI CONFORME                                           HECHO POR'));

    });

})->export('xls');


}else{


            return view('pagos.caja',['wal'=>$wal,'sumawal'=>$sumawal_total,'cierrewal'=>$cierrewal,'tipo_wal_cheque'=>$tipo_wal_cheque,'tipo_wal_efectivo'=>$tipo_wal_efectivo,'tipo_wal_vale'=>$tipo_wal_vale,'tipo_wal_tran'=>$tipo_wal_tran,'efi'=>$efi,'sumaefi'=>$sumaefi_total,'cierreefi'=>$cierreefi,'tipo_efi_cheque'=>$tipo_efi_cheque,'tipo_efi_efectivo'=>$tipo_efi_efectivo,'tipo_efi_vale'=>$tipo_efi_vale,'tipo_efi_tran'=>$tipo_efi_tran,'pre'=>$pre,'sumapre'=>$sumapre_total,'cierrepre'=>$cierrepre,'tipo_pre_cheque'=>$tipo_pre_cheque,'tipo_pre_efectivo'=>$tipo_pre_efectivo,'tipo_pre_vale'=>$tipo_pre_vale,'tipo_pre_tran'=>$tipo_pre_tran,'san'=>$san,'sumasan'=>$sumasan_total,'cierresan'=>$cierresan,'tipo_san_cheque'=>$tipo_san_cheque,'tipo_san_efectivo'=>$tipo_san_efectivo,'tipo_san_vale'=>$tipo_san_vale,'tipo_san_tran'=>$tipo_san_tran,'fecha_ca'=>$request->fecha_caja_buscar,'status'=>null]);   
            }
        }else{
            
            return view('pagos.caja',['status'=>'No existen pagos en caja con la fecha: '.$request->fecha_caja_buscar,'wal'=>null]);   

             
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
 $db= DB::table('efi_comprobante_pago as c') 
            ->where(DB::raw('CAST(c.fecha_pago as date)'),'=',new DateTime($id))
            ->update(['cierre' => '1']); 

     return view('pagos.caja',['status'=>'La Caja que corresponde a la fecha: '.$id.' ha sido cerrada','wal'=>null]);  
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
       $update_compro="0";
       $messages = [
    'motivo.required' => 'Debe especificar el motivo de la anulación',
     'motivo.min:15' => 'Debe ingresar al menos 15 caracteres',
        ];


       $validator = Validator::make($request->all(), [
            'motivo' =>'required|min:15'
        ],$messages);


        if ($validator->passes()) {


   $mytime=Carbon::now('America/Santiago');
   $mytime=date("d-m-Y h:i:s",strtotime($mytime));
   $fecha_date=date("Y",strtotime($mytime));

$maximo = DB::select("SELECT max(control::int) as control  FROM efi_comprobante_pago");
  foreach ($maximo as $varx)
      {
      //  echo $var1->id;
      }


  $black1 = Efi_Comprobante_Pago_Model::findOrFail($id);

        DB::table('efi_comprobante_pago')->insert([
            'idcliente' => $black1->idcliente,
            'idcampania' => $black1->idcampania,
            'idbase' => $black1->idbase,
            'rut' => $black1->rut,
            'dv' => $black1->dv,
            'nombre' => $black1->nombre,
            'control' => $varx->control+1,
            'idusuario' => Session::get('idusuario'),
            'fecha_actual' => $mytime,
            'fecha_pago' => $black1->fecha_pago,
            'monto_pago' => $black1->monto_pago*(-1),
            'cuenta' => $black1->cuenta,
            'tipo_pago' => $black1->tipo_pago,
            'cierre' => $black1->cierre,
            'motivo_anular' => $request->get('motivo')
            ]
        );

  $update_compro = Efi_Comprobante_Pago_Model::where('id',$id)->update(['motivo_anular' => 'ANULADO']);


         return response()->json(['bano'=>'1','nombre'=>Session::get('nombre')]);
        }else{
      
        return response()->json(['error'=>$validator->errors()->all()]);
    }
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
