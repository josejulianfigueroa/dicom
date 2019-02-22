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

// Procesos
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;



class PinController extends Controller
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

    Log::info($request->get('pin'));

    //$varlo = shell_exec(public_path().'/scripts/script.sh');

    // Log::info($varlo);
    // $process = new Process(['ls', '-lsa']);
    $process = new Process(['ls', '-lsa']);
    $process->run();

// executes after the command finishes
if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
}

echo $process->getOutput();
Log::info($process->getOutput());

    return view('welcome');
    
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
