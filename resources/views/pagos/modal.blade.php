<div class="modal fade bs-example-modal-md" id ="anular_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
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
    				
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <p  id='descripcion_anular'></p>   
                        </div>
	               </div>
				 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    					<div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                            <strong>Motivo:</strong> 
    						 <input class="form-control" name="motivo_anular" id="motivo_anular" size="200">
                            <span class="help-block">Ingrese el Motivo por el cual éste comprobante será anulado</span>
            			</div>
    				</div>			
	
      		</div>
      		</div>
			<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<input type="hidden" name="id_comprobante" id="id_comprobante">
                <input type="hidden" name="fecha_caja_buscar2" id="fecha_caja_buscar2">
				<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
				<button type="button" id="anular_pago" class="btn btn-primary anular">Confirmar</button>
			</div>
		</div>
	</div>
</div>
</div>

