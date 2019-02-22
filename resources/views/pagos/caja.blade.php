
@extends('materialdesign.mastermaterial')
@section('title', 'Ver Caja')
@section('content')
<?php
   include(app_path().'/includes/funciones.php');

?>
    <div class="container col-md-12 col-md-offset-0">
            <div class="panel panel-default">
          
            @if ($status != null)
            <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               {{$status}}
            </div>

            @endif
                @if ($wal == null)
                    <p></p>
                @else
 <div id="tabs">
  <ul>
    <li><a href="#tabs-1">WALMART</a></li>
    <li><a href="#tabs-2">EFICAZ CXC</a></li>
    <li><a href="#tabs-3">PRESTO</a></li>
    <li><a href="#tabs-4">SANTANDER</a></li>
    <li><a href="#tabs-5">RESUMEN</a></li>
  </ul>
  <div id="tabs-1">
                     <table class="table">
                        <thead>
                            <tr><th style="text-align: center;">Folio</th>
                                <th style="text-align: center;">Rut</th>
                                <th style="text-align: center;">Nombre</th>
                                <th style="text-align: center;">Usuario</th>
                                <th style="text-align: center;">Fecha de Pago</th>
                                <th style="text-align: center;">Monto</th>
                                <th style="text-align: center;">Tipo de Pago</th>
                                <th style="text-align: center;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                 @foreach($wal as $lis)
                <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis->control}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"><?php echo formatear_rut($lis->rut); ?>
                </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$lis->nombre}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->usuario }}</td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->fecha_pago }}</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($lis->monto_pago)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->tipo_pago }}</td>
              <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">@if ($lis->monto_pago >= 0 && $lis->motivo_anular === 'ANULADO') 
                  <button class="btn btn-danger">ANULADO</button>
                  @elseif ($lis->monto_pago >= 0 && $lis->motivo_anular != 'ANULADO') 
                   <button 
                 data-target="#anular_modal" data-toggle="modal"  
                 data-id="{{$lis->id}}"
                 data-control="{{$lis->control}}"
                 data-fecha_caja_buscar="<?php echo formatear_fecha($lis->fecha_pago); ?>" 
                 data-token="{!! csrf_token() !!}"
                 class="btn btn-danger">REVERSAR PAGO</button>
                   @elseif ($lis->monto_pago < 0)
                   <button class="btn btn-danger">REVERSA</button>
                    @endif
                    </td>
            </tr>
                   @endforeach
                 <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: right;">Total:</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; background-color:#1DC9F3; color:blue;"><?php echo formatear_moneda(trim($sumawal)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
              
            </tr>

         </tbody>

                    </table>

  </div>
  <div id="tabs-2">
                <table class="table">
                        <thead>
                            <tr><th style="text-align: center;">Folio</th>
                                <th style="text-align: center;">Rut</th>
                                <th style="text-align: center;">Nombre</th>
                                <th style="text-align: center;">Usuario</th>
                                <th style="text-align: center;">Fecha de Pago</th>
                                <th style="text-align: center;">Monto</th>
                                <th style="text-align: center;">Tipo de Pago</th>
                                <th style="text-align: center;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                 @foreach($efi as $lis)
                <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis->control}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"><?php echo formatear_rut($lis->rut); ?>
                </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$lis->nombre}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->usuario }}</td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->fecha_pago }}</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($lis->monto_pago)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->tipo_pago }}</td>
             <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">@if ($lis->monto_pago >= 0 && $lis->motivo_anular === 'ANULADO') 
                  <button class="btn btn-danger">ANULADO</button>
                  @elseif ($lis->monto_pago >= 0 && $lis->motivo_anular != 'ANULADO') 
                   <button 
                 data-target="#anular_modal" data-toggle="modal"  
                 data-id="{{$lis->id}}"
                 data-control="{{$lis->control}}"
                 data-fecha_caja_buscar="<?php echo formatear_fecha($lis->fecha_pago); ?>" 
                 data-token="{!! csrf_token() !!}"
                 class="btn btn-danger">REVERSAR PAGO</button>
                   @elseif ($lis->monto_pago < 0)
                   <button class="btn btn-danger">REVERSA</button>
                    @endif
                    </td>
            </tr>
                   @endforeach
                 <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: right;">Total:</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; background-color:#1DC9F3; color:blue;"><?php echo formatear_moneda(trim($sumaefi)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
              
            </tr>

                        </tbody>
                    </table>
  </div>
  <div id="tabs-3">
         <table class="table">
                        <thead>
                            <tr><th style="text-align: center;">Folio</th>
                                <th style="text-align: center;">Rut</th>
                                <th style="text-align: center;">Nombre</th>
                                <th style="text-align: center;">Usuario</th>
                                <th style="text-align: center;">Fecha de Pago</th>
                                <th style="text-align: center;">Monto</th>
                                <th style="text-align: center;">Tipo de Pago</th>
                                <th style="text-align: center;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                 @foreach($pre as $lis)
                <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis->control}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"><?php echo formatear_rut($lis->rut); ?>
                </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$lis->nombre}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->usuario }}</td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->fecha_pago }}</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($lis->monto_pago)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->tipo_pago }}</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">@if ($lis->monto_pago >= 0 && $lis->motivo_anular === 'ANULADO') 
                  <button class="btn btn-danger">ANULADO</button>
                  @elseif ($lis->monto_pago >= 0 && $lis->motivo_anular != 'ANULADO') 
                   <button 
                 data-target="#anular_modal" data-toggle="modal"  
                 data-id="{{$lis->id}}"
                 data-control="{{$lis->control}}"
                 data-fecha_caja_buscar="<?php echo formatear_fecha($lis->fecha_pago); ?>" 
                 data-token="{!! csrf_token() !!}"
                 class="btn btn-danger">REVERSAR PAGO</button>
                   @elseif ($lis->monto_pago < 0)
                   <button class="btn btn-danger">REVERSA</button>
                    @endif
                    </td>
            </tr>
                   @endforeach
                 <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: right;">Total:</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; background-color:#1DC9F3; color:blue;"><?php echo formatear_moneda(trim($sumapre)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
              
            </tr>

                        </tbody>
                    </table>
  </div>
    <div id="tabs-4">
         <table class="table">
                        <thead>
                            <tr><th style="text-align: center;">Folio</th>
                                <th style="text-align: center;">Rut</th>
                                <th style="text-align: center;">Nombre</th>
                                <th style="text-align: center;">Usuario</th>
                                <th style="text-align: center;">Fecha de Pago</th>
                                <th style="text-align: center;">Monto</th>
                                <th style="text-align: center;">Tipo de Pago</th>
                                <th style="text-align: center;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                 @foreach($san as $lis)
                <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis->control}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"><?php echo formatear_rut($lis->rut); ?>
                </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$lis->nombre}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->usuario }}</td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->fecha_pago }}</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($lis->monto_pago)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->tipo_pago }}</td>
               <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">@if ($lis->monto_pago >= 0 && $lis->motivo_anular === 'ANULADO') 
                  <button class="btn btn-danger">ANULADO</button>
                  @elseif ($lis->monto_pago >= 0 && $lis->motivo_anular != 'ANULADO') 
                   <button 
                 data-target="#anular_modal" data-toggle="modal"  
                 data-id="{{$lis->id}}"
                 data-control="{{$lis->control}}"
                 data-fecha_caja_buscar="<?php echo formatear_fecha($lis->fecha_pago); ?>" 
                 data-token="{!! csrf_token() !!}"
                 class="btn btn-danger">REVERSAR PAGO</button>
                   @elseif ($lis->monto_pago < 0)
                   <button class="btn btn-danger">REVERSA</button>
                    @endif
                    </td>
            </tr>
                   @endforeach
                 <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: right;">Total:</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; background-color:#1DC9F3; color:blue;"><?php echo formatear_moneda(trim($sumasan)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"></td>
              
            </tr>

                        </tbody>
                    </table>
  </div>
    <div id="tabs-5">
         <table class="table">
                        <thead>
                            <tr><th style="text-align: center;">Cuenta Cliente</th>
                                <th style="text-align: center;">Efectivo</th>
                                <th style="text-align: center;">Cheque</th>
                                <th style="text-align: center;">Transferencia</th>
                                <th style="text-align: center;">Vale Vista</th>
                                <th style="text-align: center;">Monto Total</th>
                                <th style="text-align: center;">Fecha</th>                             
                            </tr>
                        </thead>
                        <tbody>
                 <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">WALMART <cite>(Banco Santander, Cta. 69977251)</cite></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_wal_efectivo)); ?></td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_wal_cheque)); ?></td>
                  <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_wal_tran)); ?></td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_wal_vale)); ?></td>
                  <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($sumawal)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; ">{{$fecha_ca}}</td>
            </tr>
                            <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">EFICAZ CXC <cite>(Banco de Chile, Cta. 51216908)</cite></td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_efi_efectivo)); ?></td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_efi_cheque)); ?></td>
                  <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_efi_tran)); ?></td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_efi_vale)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($sumaefi)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; ">{{$fecha_ca}}</td>
            </tr>
                            <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">PRESTO <cite>(Banco Scotiabank, Cta. 01640100001325)</cite></td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_pre_efectivo)); ?></td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_pre_cheque)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_pre_tran)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_pre_vale)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($sumapre)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; ">{{$fecha_ca}}</td>
            </tr>
                            <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">SANTANDER <cite>(Banco Santander, Cta. 67961056)</cite></td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_san_efectivo)); ?></td>
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_san_cheque)); ?></td>
                  <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_san_tran)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($tipo_san_vale)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($sumasan)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; ">{{$fecha_ca}}</td>
            </tr>
                               <tr >
               <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: right;">Total:</td> 
               <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; background-color:#1DC9F3; color:blue;"><?php echo formatear_moneda(trim($tipo_efi_efectivo+$tipo_san_efectivo+$tipo_wal_efectivo+$tipo_pre_efectivo)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; background-color:#1DC9F3; color:blue;"><?php echo formatear_moneda(trim($tipo_efi_cheque+$tipo_san_cheque+$tipo_wal_cheque+$tipo_pre_cheque)); ?></td>
                  <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; background-color:#1DC9F3; color:blue;"><?php echo formatear_moneda(trim($tipo_efi_tran+$tipo_san_tran+$tipo_wal_tran+$tipo_pre_tran)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; background-color:#1DC9F3; color:blue;"><?php echo formatear_moneda(trim($tipo_efi_vale+$tipo_san_vale+$tipo_wal_vale+$tipo_pre_vale)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; background-color:#1DC9F3; color:blue;"><?php echo formatear_moneda(trim($sumasan+$sumapre+$sumawal+$sumaefi)); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center; "></td>
            </tr>

                        </tbody>
                    </table>
                     @if ($cierrewal == '0' and $cierresan == '0' and $cierreefi == '0' and $cierrepre == '0')
                  <div style=" text-align: right;" > 
   <a href="{{URL::action('PagosController@edit',$fecha_ca)}}" id="cerrar_cajax"><button class="btn btn-info" id="cerrar_caja">Cerrar Caja</button></a>  </div>

                    @else
                <div style=" text-align: right;" > 
                <button  class="btn btn-primary confirmar" readonly name="cerrar_caja2" type="button">Caja Cerrada</button>
                 </div>
                    @endif
       </div>


                @endif

                @include('pagos.modal')
            </div>
    </div>

@endsection