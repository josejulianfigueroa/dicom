<?php

namespace DICOM\Http\Controllers;

use DICOM\BlacklistModel;
use Illuminate\Http\Request;
use Session;
use Redirect;
use DICOM\Http\Requests\BlacklistFormRequest;
use DICOM\Http\Requests;
use DICOM\Http\Controllers\Controller;
use Illuminate\Routing\Route;

class BlacklistController extends Controller
{
 public function __construct()
    {   
       $this->middleware('checksesion');
    }

    /**

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$black = BlacklistModel::all();
        $black = BlacklistModel::paginate(10);
        return view('blacklist.index',compact('black'));
        //compact convierte en array el resultado de la consulta y asi lo pasamos a la vista

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('blacklist.create');
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlacklistFormRequest $request)
    {
       // return $request->all();
        //Slug =uniqueid();
        //BlacklistModel::create($request->all());
        $black = new BlacklistModel(array(
                'rut' => $request->get('rut'),
                'motivo' => $request->get('motivo'),
                'idcliente' => '84',
                'fono' => '0'
            )
        );
        $black->save();
        return redirect('blacklist_create')->with('status','Todo bien');
        //blacklist_crear es una ruta
            }

    /**
     * Display the specified resource.
     *
     * @param  \DICOM\BlacklistModel  $blacklistModel
     * @return \Illuminate\Http\Response
     */
    public function show($rut)
    {
         $black = BlacklistModel::where('rut',$rut)->first();
        return view('blacklist.mostrar',compact('black'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \DICOM\BlacklistModel  $blacklistModel
     * @return \Illuminate\Http\Response
     */
    public function edit($rut)
    {
      $black = BlacklistModel::where('rut',$rut)->first();
        return view('blacklist.edit',compact('black'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \DICOM\BlacklistModel  $blacklistModel
     * @return \Illuminate\Http\Response
     */
    public function update($rut, BlacklistFormRequest $request)
    {
          
         $black = BlacklistModel::where('rut',$rut)->update(['motivo' =>$request->get('motivo')]);
         //$black->motivo= $request->get('motivo');
         //$black->save();
         /*
            $user = User::find($id);
            $user->fill($request->all());
            Session::flash('mensaje','usuario x');
            Redirect::to('/usuario');
         */
       
       return redirect('/blacklist')->with('status','El registro de ha actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \DICOM\BlacklistModel  $blacklistModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($rut)
    {
       $black = BlacklistModel::where('rut',$rut)->delete();
       return redirect('/blacklist')->with('status','El registro de ha borrado');
    }
}
