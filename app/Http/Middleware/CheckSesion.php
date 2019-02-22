<?php

namespace DICOM\Http\Middleware;
use Session;
use Closure;
use Redirect;

class CheckSesion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

         if(!Session::has('nombre')){    
           return Redirect::to('/');
       }

        return $next($request);
    }
}
