<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<!--<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                 <h4 class="modal-title" id="titulo"></h4>
			</div>-->
			<div class="modal-body">

				<div class="panel panel-primary">
					<div class="panel-heading">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     		<span aria-hidden="true">×</span>
                		</button>
                 		<h4 class="modal-title" id="titulo"></h4>
					</div>
 					<div class="panel-body">
 						 
    <div class="alert alert-danger print-error-msg alert-dismissable" style="display:none">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul></ul>
    </div>
    <div id="resultado" ></div>
				<div class="row" id="datosmax" style="display:none">  

				  <div class="panel panel-primary">
					<div class="panel-heading" style="background-color:#1F618D;">
						<strong>Datos del Cliente</strong>
					</div>

					<div class="panel-body" >
					@if(Session::get('idusuario') == '1556')
					<div style="text-align: right;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label class="radio-inline"><input type="radio" name="cliente_check" id="cliente_check_0" value="0">
						<i class="fa fa-window-close" aria-hidden="true"></i>&nbsp;NO
				</label>
				<label class="radio-inline"><input type="radio" name="cliente_check" id="cliente_check_1" value="1">
						<i class="fa fa-check" aria-hidden="true"></i>&nbsp;SI
				</label>
					</div>
					@endif
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Cliente</strong> 
               				<p  id='cliente'></p>	
            			</div>
    				</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Rut</strong> 
               				<p  id='rut'></p>	
            			</div>
    				</div>
    				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Nombre</strong> 
               				<p  id='nombre'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Email</strong> 
               				<p  id='email'></p>	
            			</div>
    				</div>
    				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Dirección</strong> 
               				<p  id='dire'></p>	
            			</div>
    				</div>
    			    </div>
    		   </div>

    				<div class="panel panel-primary">
					<div class="panel-heading" style="background-color:#1F618D;">
						<strong>Datos del Convenio</strong></div>
					</div>
					@if(Session::get('idusuario') == '1556')
					<div style="text-align: right;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label class="radio-inline"><input type="radio" id="convenio_check_0" name="convenio_check" value="0">
						<i class="fa fa-window-close" aria-hidden="true"></i>&nbsp;NO
				</label>
				<label class="radio-inline"><input type="radio" id="convenio_check_1" name="convenio_check" value="1">
						<i class="fa fa-check" aria-hidden="true"></i>&nbsp;SI
				</label>
					</div>
					@endif
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Fecha Convenio</strong> 
                			<p  id='fecha_convenio'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Monto Convenio</strong> 
                			<p  id='monto_convenio'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Monto Cuota</strong> 
                			<p  id='monto_cuotas'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Monto Deuda</strong> 
                			<p  id='monto_deuda'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Monto Dcto.</strong> 
                			<p  id='monto_dcto'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Abono Inical</strong> 
                			<p  id='abono_inicial'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Tipo de Ajuste</strong> 
                			<p  id='tipo_ajuste'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Usuario Autoriza</strong> 
                			<p  id='codigo_usuario_autoriza'></p>	
            			</div>
    				</div>
    	
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Cuotón</strong> 
                            <p  id='cuoton'></p>    
                        </div>
                    </div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Total de Cuotas</strong> 
                			<p  id='total_cuotas'></p>	
            			</div>
    				</div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Cuotas Pagadas</strong> 
                            <p  id='cuotas_pagadas'></p>    
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Cuota Actual</strong> 
                            <p  id='cuota_actual'></p>    
                        </div>
                    </div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>¿Pagare?</strong> 
                			<p  id='pagare'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Fecha Vigente</strong> 
                			<p  id='fecha_vigente'></p>	
            			</div>
    				</div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Fecha Ingreso</strong> 
                            <p  id='fecha_actual'></p>   
                        </div>
                    </div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Fecha Cancelado</strong> 
                			<p  id='fecha_cancelado'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Fecha Primer Vcto.</strong> 
                			<p  id='fecha_primer_vcto'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Fecha Abono</strong> 
                			<p  id='fecha_abono'></p>	
            			</div>
    				</div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Fecha Roto</strong> 
                			<p  id='fecha_roto'></p>	
            			</div>
    				</div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Fecha Pagaré Generado</strong> 
                            <p  id='fecha_pagare_generado2'></p>    
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Fecha Pagaré Firmado</strong> 
                            <p  id='fecha_pagare_firmado2'></p>    
                        </div>
                    </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Fecha Pagaré Ingreso</strong> 
                            <p  id='fecha_pagare_ingreso2'></p>    
                        </div>
                    </div>
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Fecha Entrega Pagaré</strong> 
                            <p  id='fecha_entrega_pagare2'></p>    
                        </div>
                    </div>
    				@if(Session::get('idusuario') == '1556')
				 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    						<strong>Motivo del Rechazo</strong> 
    						 <textarea class="form-control" name="motivo" id="motivo" rows="1" ></textarea>
                            <span class="help-block">Motivo del Por qué? el convenio es rechazado</span>
            			</div>
    				</div>	
    				@else
    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="divmotivo" style="display:none">
    					<div class="form-group">
    						<strong>Motivo del Rechazo</strong> 
    						 <textarea class="form-control" disabled name="motivo2" id="motivo2" rows="1" ></textarea>
                            <span class="help-block">Motivo del Por qué? el convenio es rechazado</span>
            			</div>
    				</div>
					@endif
             

				</div>
      		</div>
      		</div>
                @if(Session::get('idusuario') == '628') 
               <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:#1F618D;">
                        <strong>Actualizar Datos del Pagaré</strong>
                    </div>

                    <div class="panel-body" >
                        <!--
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                   
                            <strong>¿Pagaré Firmado?</strong> 
                          <select name='pagare_firmado' id='pagare_firmado' class="form-control pagare_firmado_clase">
                               
                            </select> 
                    </div>-->
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"  class="form-group" style="padding-top: 0; padding-bottom: 0; margin-bottom: 0; margin-top: 0;">
                        <strong>Fecha Generación del Pagaré</strong> 
                        <input type="text" class="form-control datepicker" name="fecha_pagare_generado"  id='fecha_pagare_generado'>
                    </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"  class="form-group" style="padding-top: 0; padding-bottom: 0; margin-bottom: 0; margin-top: 0;">
                        <strong>Fecha Firma del Pagaré</strong> 
                        <input type="text" class="form-control datepicker" name="fecha_pagare_firmado"  id='fecha_pagare_firmado'>
                    </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"  class="form-group" style="padding-top: 0; padding-bottom: 0; margin-bottom: 0; margin-top: 0;">
                        <strong>Fecha Entrega Pagaré</strong> 
                        <input type="text" class="form-control datepicker" name="fecha_entrega_pagare"  id='fecha_entrega_pagare'>
                    </div>
                        
                </div>
                </div>
                 @endif

      		</div>
      		<!--{{Form::Open(array('action'=>array('ConveniosController@show',$lis->id),'method'=>'show'))}}
      		{{ csrf_field() }}-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				@if(Session::get('idusuario') == '1556')
				<input type="hidden" name="idconvenio" id="idconvenio">
				<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
				<button type="button" id="confirmar" class="btn btn-primary confirmar">Confirmar</button>
                @elseif(Session::get('idusuario') == '628')
                <input type="hidden" name="idconvenio" id="idconvenio">
                <input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
                <button type="button" id="confirmar_pagare" class="btn btn-primary confirmar_pagare">Guardar</button>

				@else
				<button type="button" data-dismiss="modal" class="btn btn-primary">Confirmar</button>
				@endif
			</div>
			<!--{{Form::Close()}}-->
		</div>
	</div>
</div>
</div>

