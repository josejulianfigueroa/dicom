
@extends('materialdesign.mastermaterial')
@section('title', 'Ver Lista Aclaracion')
@section('content')
<?php
   include(app_path().'/includes/funciones.php');

?>
    <div class="container col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Lista Ruts para Aclarar </h2>
                </div>
    
            @include('aclarar.search')

                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Rut</th>
                                <th style="text-align: center;">Dv</th>
                                <th style="text-align: center;">Fecha Protesto</th>
                                <th style="text-align: center;">N Operacion</th>
                                <th style="text-align: center;">Monto Deuda</th>
                                <th style="text-align: center;">Fecha Pago</th>
                                <th style="text-align: center;">Fondo</th>
                                <th style="text-align: center;">Estado Dicom</th>
                                <th style="text-align: center;">Estado Convenio</th>
                                <th style="text-align: center;">Monto Aclarar</th>
                            </tr>
                        </thead>
                        <tbody>
                 @foreach($lista as $lis)
                <tr >

                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis->rut}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->dv }}</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis->fecha_protesto}}</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis->nro_operacion}}</td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis->monto_deuda}}</td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->fecha_de_pago }}</td>

                  <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                    {{$lis->fondo}}

                </td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->estado_dicom }}</td>
                  <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->estado }}</td>
                   <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->monto_protesto }}</td>
            </tr>
         
            @endforeach
                        </tbody>
                       
                    </table>
                
            </div>
    </div>

@endsection