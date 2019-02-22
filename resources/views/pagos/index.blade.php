
@extends('materialdesign.mastermaterial')
@section('title', 'Estado de Cuenta')
@section('content')
<?php
   include(app_path().'/includes/funciones.php');

?>
    <div class="container col-md-12 col-md-offset-0">
            <div class="panel panel-default">
          
            @if ($status == '')
            @else
            <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $status }}
            </div>

            @endif
            @include('pagos.search')

                @if ($lista->isEmpty())
                    <p></p>
                @else
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
          <div class="panel panel-primary">
           
                    <div class="panel-heading" >
                        <strong>Datos del Cliente</strong>
                    </div>

                    <div class="panel-body" style="font-size: 14px;" >
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; ">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Rut</strong> 
                            <p  id='rut'>{{$searchText}}</p>   
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; font-size: 13px;">
                        <div class="form-group" style="padding-top: 0; padding-left: 10; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Nombre</strong> 
                            <p  id='nombre'>{{$nombre}}</p>    
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Email</strong> 
                            <p  id='email'>{{$email}}</p> 
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Dirección</strong> 
                            <p  id='dire'>{{$dire}}</p>  
                        </div>
                    </div>
                    </div>
                     </div> 


 </div>   
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="noprint2">
              <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:#1F618D;">
                        <strong>Datos del Convenio</strong>
                    </div>
            

                    <table class="table" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Id</th>
                                <th style="text-align: center;">Cliente</th>
                                <th style="text-align: center;">Rut</th>
                                <th style="text-align: center;">Nro.</th>
                                <th style="text-align: center;">Ejecutivo</th>
                                <th style="text-align: center;">Fecha Convenio</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                 @foreach($lista as $lis)
                <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis->id}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">@if ($lis->idcliente === 60) Presto 
                         @elseif ($lis->idcliente === 84) Eficaz
                         @elseif ($lis->idcliente === 83) Walmart
                         @else Santander
                    @endif 
                </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_rut($lis->rut); ?></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->nro }}</td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->nombre }}</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_fecha($lis->fecha_convenio); ?></td>
              
            </tr>
         
       @endforeach
                        </tbody>
                    <table class="table" style="margin-top: 0; font-size: 14px;">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Monto Convenio</th>
                                <th style="text-align: center;">Monto Cuota</th> 
                                <th style="text-align: center;">Monto Desc.</th>
                                <th style="text-align: center;">Abono</th>
                                <th style="text-align: center;">Monto Deuda</th>
                            </tr>
                        </thead>
                        <tbody>
                 @foreach($lista as $lis)
                <tr >
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"> 
                    <?php echo formatear_moneda(trim($lis->monto_convenio)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($lis->monto_cuotas)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($lis->monto_dcto)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($lis->abono_inicial)); ?></td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($montodeuda)); ?>
                </td>
              
            </tr>
         
         @endforeach
                        </tbody>
                       
                    </table>
                     <table class="table" style="margin-top: 0; font-size: 14px;">
                        <thead>
                            <tr> 
                                <th style="text-align: center;">Cuotón</th>
                                <th style="text-align: center;">Primer Vcto.</th>
                                <th style="text-align: center;">Tipo Ajuste</th>
                                <th style="text-align: center;">Pagaré?</th>
                                <th style="text-align: center;">Fecha Abono</th>
                                <th style="text-align: center;">Fecha Vigente</th>
                               
                            </tr>
                        </thead>
                        <tbody>
            
                <tr > @foreach($lista as $lis)
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$lis->cuoton}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$lis->primer_vcto}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->tipo_ajuste }} 
                </td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$lis->pagare}}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php formatear_fecha($lis->fecha_abono); ?></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_fecha($lis->fecha_vigente); ?></td>
               
            </tr>
         
            @endforeach
                        </tbody>
                       
                    </table>

                      <table class="table" style="margin-top: 0; font-size: 14px;">
                        <thead>
                            <tr> 
               
                                <th style="text-align: center;">Fecha Roto</th>
                                <th style="text-align: center;">Fecha Canc.</th>
                                <th style="text-align: center;">Total Cuotas</th>  
                                <th style="text-align: center;">Cuotas Pag.</th>
                            <!--    <th style="text-align: center;">Cuota Actual</th> -->
                                <th style="text-align: center;">Fecha Ingreso</th>
                            </tr>
                        </thead>
                        <tbody>
            
                <tr > @foreach($lista as $lis)
             
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_fecha($lis->fecha_roto); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_fecha($lis->fecha_cancelado); ?></td>  
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$lis->total_cuotas}}</td>    
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$cuotas_pagadas}}</td>
                <!-- <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$cuota_actual}}</td>-->
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_fecha($lis->fecha_actual); ?></td>
            </tr>
         
            @endforeach
                        </tbody>
                       
                    </table>

                    <table class="table" style="margin-top: 0; font-size: 14px;">
                        <thead>
                            <tr> 
               
                                <th style="text-align: center;">Fecha Prox. Pago</th>
                                <th style="text-align: center;">Dias Mora</th>
                                <th style="text-align: center;">Saldo Mora</th>  
                                <th style="text-align: center;">Q Cuotas Morosas</th>
                            <!--    <th style="text-align: center;">Cuota Actual</th> -->
                                <th style="text-align: center;">Estado Convenio</th>
                            </tr>
                        </thead>
                        <tbody>
            
                <tr >
             
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_fecha($fecha_proximo_pago); ?></td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo $dias_mora; ?></td>  
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;"><?php echo formatear_moneda(trim($saldo_mora)); ?></td>    
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$cantidad_cuotas_morosas}}</td>
                <!-- <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{$cuota_actual}}</td>-->
                @foreach($lista as $lis)
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0; text-align: center;">{{ $lis->estado_tabla_a }}</td>
                @endforeach
            </tr>
         
                        </tbody>
                       
                    </table>




             </div>   </div>
  @if ($status == '' && Session::get('rol') > 1 )
           
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="noprint3" style="font-size: 14px;">
              <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:#1F618D;">
                        <strong>Datos del Pago a Cancelar</strong>
                    </div>
            <div class="panel-body" >
                   
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 14px;" >
                       <!-- <h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sub Total</strong></h4>-->
                    </div>
                     
                 <table class="table" id="tablita" style="font-size: 14px;" ></table>
    {!! Form::open(array('url'=>'/pagos','method'=>'GET','autocomplete'=>'off','role'=>'searche','id'=>'form_pago')) !!}
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; font-size: 14px;">
                       <h4><strong><select name='tipo_pago' id='tipo_pago' onchange="getval(this);" class="form-control" style="text-align: center; padding-top: 0; margin-top: 0; padding-bottom: 0; margin-bottom: 0; font-size: 14px;">
                     <option value='SELECCIONAR' selected>Seleccione Tipo de Pago</option> 
                     <option value='EFECTIVO' >EFECTIVO</option>
                     <option value='VALE VISTA'>VALE VISTA</option> 
                     <option value='CHEQUE'>CHEQUE</option>  
                     <option value='TRANSFERENCIA'>TRANSFERENCIA</option>   
                     </select>   
                </strong></h4>
                </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="ver1" style="text-align: center; display: none; font-size: 14px;">
        <h4><strong>Monto a Pagar:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  style="text-align: center; padding-top: 0; margin-top: 0; padding-bottom: 0; margin-bottom: 0; color:blue;"  type="text"  size="10"  name="otro_monto1" id="otro_monto1" onkeyup="Limpiar_Vuelto(this);"></strong></h4>
        </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  id="ver2" style="text-align: center; display: none;">
        <h4><strong>¿Con cuanto paga?:&nbsp;&nbsp;<input  style="text-align: center; padding-top: 0; margin-top: 0; padding-bottom: 0; margin-bottom: 0; background-color:grey; color:blue;" onkeyup="Limpiar_Vuelto(this);" type="text"  size="10" name="otro_monto2" id="otro_monto2"></strong></h4>
        </div>
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  id="ver4" style="text-align: center; display: none; text-align: center; ">
        <input style="font-weight: bold; a"  type="button"   name="redondeo" id="redondeo"  value="Calcular Vuelto">
        </div>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="ver3" style="text-align: center; display: none; font-size: 14px;">
        <h4><strong>Vuelto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  style="text-align: center; padding-top: 0; margin-top: 0; padding-bottom: 0; margin-bottom: 0;  color:blue;"  type="text"  size="10" readonly  name="otro_monto3" id="otro_monto3"></strong></h4>
        </div>
             <div class="from-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; font-size: 14px;" id="pagando_div">
                <button  class="btn btn-primary confirmar" name="pagando" value="1" id ="pagando" type="submit">Pagar</button>
                <input type="hidden"  name="sumita" id="sumita" value="{{$sumita}}">
                <input type="hidden"  name="acumula2" id="acumula2">
                <input type="hidden"  name="dv0"  value="{{$dv}}">
                <input type="hidden"  name="rut0"  value="{{$searchText}}">
                <input type="hidden"  name="idcliente0"  value="{{$lis->idcliente}}">
                <input type="hidden"  name="idcampania0"  value="{{$lis->idcampania}}">
                <input type="hidden"  name="nombre0"  value="{{$nombre}}">   
</div>{{Form::close()}}
               
            </div>    
        </div>
        </div>
@endif
        </div>


                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="font-size: 14px; padding-left: 0; padding-right: 0;">


                        <div id="tabs">
  <ul>
    <li><a href="#tabs-1">Estado de Cuotas</a></li>
    <li><a href="#tabs-2">Pagos</a></li>
    <li><a href="#tabs-3">Historia</a></li>
  </ul>
  <div id="tabs-1">
      <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:#F3471D;">
                        <strong>Estado de Cuotas del Convenio</strong>
                    </div>
                      <table class="table" style="font-size: 14px;">
                        <thead>
                            <tr> 
                                <th style="text-align: center;">N° Cuota</th>
                                <th style="text-align: center; width: 160">Estado Cuota</th>
                                <th style="text-align: center;">Fecha Vencimiento</th>
                                <th style="text-align: center;">Monto Cuota</th> 
                                <th style="text-align: center;">Saldo</th> 
                                <th style="text-align: center; width: 100">Acción</th> 
                            </tr>
                        </thead>
                        <tbody>   
            @foreach($lista2 as $lis2)
                <tr >
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis2->id}}</td>
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis2->estado}}</td>
                <td style=" height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis2->fecha_vcto}}</td>  
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis2->monto}}</td> 
                <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$lis2->saldo}}</td> 
                 <td style="height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <?php $acti=''; ?>
                        @if (Session::get('rol') < 2)
                            <?php $acti=' disabled '; ?>
                        @endif


                    @if ($lis2->estado === 'POR PAGAR' OR $lis2->estado === 'ABONO POR PAGAR' OR $lis2->estado === 'ABONADA' OR $lis2->estado === 'MOROSA') 
                    @if ($lis2->vencida === '1')
                      
    <label class="checkbox-inline"><input type="checkbox" name= "{{$lis2->id}}" id="{{$lis2->id}}" class="accion" value="1" checked <?php echo $acti; ?> >&nbsp;PAGAR
                    <input type="hidden" id="saldo{{$lis2->id}}" value="{{$lis2->saldo}}">
                    <input type="hidden" id="total_cuotas" value="{{$lis->total_cuotas}}">

                </label>
                     @else 
                         <label class="checkbox-inline"><input type="checkbox" name= "{{$lis2->id}}" id="{{$lis2->id}}" class="accion" <?php echo $acti; ?>  value="1">&nbsp;PAGAR
                    <input type="hidden" id="saldo{{$lis2->id}}" value="{{$lis2->saldo}}">
                    <input type="hidden" id="total_cuotas" value="{{$lis->total_cuotas}}">
                </label>
                          @endif 
                
                          @else -
                          @endif </td>     
            </tr> @endforeach
                  </tbody>  
                    </table>
             </div>
     </div>
     <div id="tabs-2">
 <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:#F3471D;">
                        <strong>Pagos del Cliente</strong>
                    </div>
                      <table class="table" style="font-size: 14px;">
                        <thead>
                            <tr> 
                            <th style="text-align: center;">Monto ($)</th>
                            <th style="text-align: center;">Fecha Pago</th>
                               </th> 
                            </tr>
                        </thead>
                        <tbody>   
            @foreach($pagos as $pago)
                <tr >
                <td style="text-align: center; height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$pago->monto}}</td>
                <td style="text-align: center; height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$pago->fecha_pago2}}</td>
                </tr> 
            @endforeach
                  </tbody>  
                    </table>
             </div>
     </div>
     <div id="tabs-3">
 <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:#F3471D;">
                        <strong>Gestiones del Cliente</strong>
                    </div>
                      <table class="table" style="font-size: 14px;">
                        <thead>
                            <tr> 
                            <th style="text-align: center;">Fecha</th>
                            <th style="text-align: center;">Fono</th>
                            <th style="text-align: center;">Ejecutivo</th>
                            <th style="text-align: center;">Gestion</th>
                            <th style="text-align: center;">Observacion</th>
                               </th> 
                            </tr>
                        </thead>
                        <tbody>   
            @foreach($historia as $histo)
                <tr >
                <td style="text-align: center; height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$histo->fecha}}</td>
                <td style="text-align: center; height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$histo->codarea}}-{{$histo->fono}}</td>
                <td style="text-align: center; height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$histo->nombre}}</td>
                <td style="text-align: center; height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$histo->descripcion}}</td>
                <td style="text-align: center; height: 0px;padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{$histo->observacion}}</td>
                </tr> 
            @endforeach
                  </tbody>  
                    </table>
             </div>
     </div>  </div> 
                  </div>
       
    
 
           
                       @include('convenios.modal')
                 
                @endif
            </div>
    </div>

@endsection