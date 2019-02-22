<?php

namespace DICOM\Http\Controllers;

use Illuminate\Http\Request;
use DICOM\Http\Requests\DicomFormRequest;
use DB;
use Session;
use Redirect;
use DICOM\DicomModel;
use DICOM\DicomBaseModel;

class DicomListaController extends Controller
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
            $query= strtolower(trim($request->get('searchText')));

            $lista= DB::table('efi_dicom_lista as l')
                  ->join('efi_dicom_base as b',function($join){
                    $join->on('l.idcliente','=','b.idcliente');
                    $join->on('l.rut','=','b.rut');
                })
                    ->select('l.id','b.id as id_cli','l.idcliente','l.rut','l.dv','b.apellido_pat as apellido_pat','b.apellido_mat as apellido_mat','b.nombres as nombres','l.moneda','l.monto_protesto','l.fecha_vencimiento','l.fecha_protesto','l.numero_documento','l.situacion','l.fecha_aclaracion')
                    ->whereRaw( 'LOWER(l.rut) like ?', array( '%'.$query.'%' ) )
                    ->orwhereRaw( 'LOWER(b.nombres) like ?', array( '%'.$query.'%' ) )
                   // ->where('l.rut','like','%'.$query.'%')
                   // ->orwhere('lower(b.nombres)','like','%lower('.$query.')%')
                    ->orderBy('l.fecha_protesto')
                    ->paginate(10);

            return view('dicom.index',['lista'=>$lista,'searchText'=>$query]);
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
       // return view('dicom/edit',['lista'=>DICOM\DicomModel::])
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $lista = DicomModel::findOrFail($id);
    $cli = DicomBaseModel::where('rut',$lista->rut)->where('idcliente',$lista->idcliente)->first(); 
    
        return view('dicom/edit',['lista'=>$lista,'cli'=>$cli]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DicomFormRequest $request, $id)
    {
       $lista = DicomModel::findOrFail($id);
       $lista->rut=$request->get('rut');
       $lista->dv=$request->get('dv');
       //$lista->idcliente=$request->get('idcliente');
       $lista->monto_protesto=$request->get('monto_protesto');
       $lista->moneda=$request->get('moneda');
       $lista->fecha_vencimiento=$request->get('fecha_vencimiento');
       $lista->fecha_protesto=$request->get('fecha_protesto');
       $lista->numero_documento=$request->get('numero_documento');
       $lista->situacion=$request->get('situacion');
       $lista->fecha_envio_aclaracion=$request->get('fecha_envio_aclaracion');
       $lista->fecha_aclaracion=$request->get('fecha_aclaracion');
       $lista->observacion=$request->get('observacion');
    
       $lista->update();

        $cli = DicomBaseModel::findOrFail($request->get('id_cli'));
        $cli->apellido_mat=$request->get('apellido_mat');
        $cli->apellido_pat=$request->get('apellido_pat');
        $cli->nombres=$request->get('nombres');

        $cli->update();

       return Redirect::to('/dicom')->with('status','Datos Actualizados con éxito');

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
