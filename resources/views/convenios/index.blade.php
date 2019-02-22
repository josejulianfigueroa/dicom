
@extends('materialdesign.mastermaterial')
@section('title', 'Ver Lista Convenios')
@section('content')
<?php
   include(app_path().'/includes/funciones.php');

?>
    <div class="container col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Lista Convenios </h2>
                </div>
            @if (session('status'))
            <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
            @endif
            @include('convenios.search')

                @if ($lista->isEmpty())
                    <p>No hay Ningún Convenio</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Cliente</th>
                                <th style="text-align: center;">Rut</th>
                                <th style="text-align: center;">Nro.</th>
                                <th style="text-align: center;">Fecha Convenio</th>
                                <th style="text-align: center;">Monto Convenio</th>
                                <th style="text-align: center;">Monto Cuota</th>
                                <th style="text-align: center;">Ejecutivo</th>
                                <th style="text-align: center;">Estado Convenio</th>
                                <th style="text-align: center;">Estado Auditoria</th>
                                <th style="text-align: center;">Detalle</th>
                                <th style="text-align: center;">Grabación</th>
                            </tr>
                        </thead>
                        <tbody>
                 @foreach($lista as $lis)
                <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">@if ($lis->idcliente === 60) Presto 
                         @elseif ($lis->idcliente === 84) Eficaz
                         @elseif ($lis->idcliente === 83) Walmart
                         @else Santander
                    @endif 
                </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis->rut}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->nro }}</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"><?php echo formatear_fecha($lis->fecha_convenio); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"><?php echo formatear_moneda($lis->monto_convenio); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"><?php echo formatear_moneda($lis->monto_cuotas); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->nombre }}</td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->estado_tabla_a }}</td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">@if ($lis->estado === null) SIN ESTADO 
                    @else {{ $lis->estado }}
                    @endif
                </td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"><?php $cliente=''; 
                    if ($lis->idcliente == 60) { $cliente='Presto';}
                    if ($lis->idcliente == 84) { $cliente='Eficaz';}
                    if ($lis->idcliente == 83) { $cliente='Walmart';}
                    if ($lis->idcliente == 68) { $cliente='Santander';}
                    ?>
                 <button 
                 data-target=".bs-example-modal-lg" data-toggle="modal"  
                 data-id="{{$lis->id}}" 
                 data-rut="{{$lis->rut}}" 
                 data-rut2="<?php echo formatear_rut($lis->rut); ?>" 
                 data-cuoton="<?php echo formatear_moneda($lis->cuoton); ?>" 
                 data-cliente="<?php echo $cliente;?>" 
                 data-fecha_convenio="<?php echo formatear_fecha($lis->fecha_convenio); ?>" 
                 data-monto_convenio="<?php echo formatear_moneda($lis->monto_convenio); ?>" 
                 data-monto_cuotas="<?php echo formatear_moneda($lis->monto_cuotas); ?>" 
                 data-monto_deuda="<?php echo formatear_moneda($lis->monto_deuda); ?>" 
                 data-monto_dcto="<?php echo formatear_moneda($lis->monto_dcto); ?>" 
                 data-abono_inicial="<?php echo formatear_moneda($lis->abono_inicial); ?>" 
                 data-total_cuotas="{{$lis->total_cuotas}}" 
                 data-tipo_ajuste="{{$lis->tipo_ajuste}}"
                 data-cuota_morosa_total="{{$lis->cuota_morosa_total}}"
                 data-pagare="{{$lis->pagare}}"
                 data-fecha_pagare_firmado="{{$lis->fecha_pagare_firmado}}"
                 data-fecha_pagare_generado="{{$lis->fecha_pagare_generado}}"
                 data-fecha_pagare_ingreso="{{$lis->fecha_pagare_ingreso}}"
                 data-fecha_entrega_pagare="{{$lis->fecha_entrega_pagare}}"
                 data-fecha_vigente="<?php echo formatear_fecha($lis->fecha_vigente); ?>" 
                 data-fecha_cancelado="<?php echo formatear_fecha($lis->fecha_cancelado); ?>" 
                 data-fecha_primer_vcto="<?php echo formatear_fecha($lis->primer_vcto); ?>" 
                 data-fecha_abono="<?php echo formatear_fecha($lis->fecha_abono); ?>" 
                 data-fecha_roto="<?php echo formatear_fecha($lis->fecha_roto); ?>" 
                 data-codigo_usuario_autoriza="{{$lis->codigo_usuario_autoriza}}"
                 data-token="{!! csrf_token() !!}"
                 data-idcampania="{{$lis->idcampania}}"
                 data-contacto="{{$lis->contacto}}"
                 data-convenio="{{$lis->convenio}}"
                 data-observacion="{{$lis->observacion}}"
                 data-idconvenio="{{$lis->idconvenio}}"
                 data-estado="{{$lis->estado}}"
                 data-fecha_actual="{{$lis->fecha_actual}}"
                 class="btn btn-danger">Ver</button></td><td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                   <?php $cad = asset('grabaciones/48996.WAV');
                         $pad = public_path().'/grabaciones/'.$lis->id.'.WAV';
                         $pad3 ="http://" . $_SERVER["SERVER_NAME"].'/grabaciones/'.$lis->id.'.WAV';

                    if(File::exists($pad)){?>
                  <a href="{{asset('grabaciones/'.$lis->id.'.WAV')}}" class="btn btn-default btn-md" data-toggle="tooltip" data-placement="bottom" title="Descargar Grabación" download><i class="fa fa-download"></i></a>
                    <?php }else{ ?>
                     <a href="" class="btn btn-default btn-md" data-toggle="tooltip" data-placement="bottom" title="No tiene Grabación"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                    
                    <?php }?>
                    </td>
            </tr>
         
            @endforeach
                        </tbody>
                       
                    </table>
                       @include('convenios.modal')
                     {{$lista->appends(Request::input())->links() }}
                    
                @endif
            </div>
    </div>

@endsection