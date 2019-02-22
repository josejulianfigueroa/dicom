<?php

namespace DICOM\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class DicomController extends Controller
{
     public function SinAjax()
    {
    	return view('dicom.create');
    }

    /**
     * Display a listing of the myformPost.
     *
     * @return \Illuminate\Http\Response
     */
    public function Ajax(Request $request)
    {

    	$validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        if ($validator->passes()) {

			return response()->json(['success'=>'Added new records.']);
        }

    	return response()->json(['error'=>$validator->errors()->all()]);
    }
}
