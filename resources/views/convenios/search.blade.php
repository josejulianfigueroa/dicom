{!! Form::open(array('url'=>'/convenios','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group" style="padding-left: 10px; padding-right:40px;">
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
			<input type="text" class="form-control"  name="searchText" placeholder="Rut..." value="{{$searchText}}">
		</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
		<input type="text" class="form-control datepicker"  name="searchFecha1" placeholder="Fecha Ini..." value="{{$searchFecha1}}">
		</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
		<input type="text" class="form-control datepicker"  name="searchFecha2" placeholder="Fecha Fin..." value="{{$searchFecha2}}">
			</div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <select name='searchEstadoC' class="form-control"> 
                @if($searchEstadoC==='84')
                     <option value='84' selected>EFICAZ</option>
                     <option value=''>Cedente</option>  
                     <option value='60'>PRESTO</option>
                     <option value='68'>SANTANDER</option>
                     <option value='83'>WALMART</option>     
                @elseif($searchEstadoC==='60')
                     <option value='60' selected>PRESTO</option>
                     <option value=''>Cedente</option>  
                     <option value='68'>SANTANDER</option>
                     <option value='83'>WALMART</option>     
                     <option value='84'>EFICAZ</option>
                @elseif($searchEstadoC==='68')
                     <option value='68' selected>SANTANDER</option>
                     <option value='' >Cedente</option>  
                     <option value='83'>WALMART</option>     
                     <option value='84'>EFICAZ</option>
                     <option value='60'>PRESTO</option>
                 @elseif($searchEstadoC==='83')
                     <option value='83' selected>WALMART</option>
                     <option value=''>Cedente</option>  
                     <option value='84'>EFICAZ</option>
                     <option value='60'>PRESTO</option>
                     <option value='68'>SANTANDER</option>
                 @else
                     <option value='' selected>Cedente</option>   
                     <option value='84'>EFICAZ</option>
                     <option value='60'>PRESTO</option>
                     <option value='68'>SANTANDER</option>
                    <option value='83'>WALMART</option>    
                @endif
                </select>     
            </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    <select name='searchEfitramo2' class="form-control">
                    @if ($nombre2=='')
                    <option value='Seleccionar'>Efitramo</option>
                        @else
                    <option value='{{$searchEfitramo2}}'>{{$nombre2}}</option>
                     <option value='Seleccionar'>Efitramo</option>
                         @endif  
                         @foreach ($searchEfitramo as $eje2)
                            <option value='{{$eje2->id}}-{{$eje2->nombre}}'>{{$eje2->nombre}}</option>
                         @endforeach
                    </select>
                </div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<select name='searchEstadoA' class="form-control"> 
                @if($searchEstadoA==='CONVENIO CANCELADO')
                	 <option value='CONVENIO CANCELADO' selected>CONVENIO CANCELADO</option>
                     <option value=''>Estado Convenio</option>  
                     <option value='ACTIVO'>ACTIVO</option>
                     <option value='ROTO'>ROTO</option>
                     <option value='VIGENTE'>VIGENTE</option>     
                @elseif($searchEstadoA==='ROTO')
                     <option value='ROTO' selected>ROTO</option>
                     <option value=''>Estado Convenio</option>  
                     <option value='ACTIVO'>ACTIVO</option>
                     <option value='CONVENIO CANCELADO'>CONVENIO CANCELADO</option>
                     <option value='VIGENTE'>VIGENTE</option>  
                @elseif($searchEstadoA==='VIGENTE')
                     <option value='VIGENTE' selected>VIGENTE</option>
                     <option value='' >Estado Convenio</option>  
                     <option value='ACTIVO'>ACTIVO</option>
                     <option value='CONVENIO CANCELADO'>CONVENIO CANCELADO</option>
                     <option value='ROTO'>ROTO</option>
                 @elseif($searchEstadoA==='ACTIVO')
                     <option value='ACTIVO' selected>ACTIVO</option>
                     <option value=''>Estado Convenio</option>  
                     <option value='CONVENIO CANCELADO'>CONVENIO CANCELADO</option>
                     <option value='ROTO'>ROTO</option>
                     <option value='VIGENTE'>VIGENTE</option>    
                 @else
                     <option value='' selected>Estado Convenio</option>   
                     <option value='ACTIVO'>ACTIVO</option>
                     <option value='CONVENIO CANCELADO'>CONVENIO CANCELADO</option>
                     <option value='ROTO'>ROTO</option>
                     <option value='VIGENTE'>VIGENTE</option>    
                @endif
                </select>     
			</div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <select name='searchEstado' class="form-control"> 
               @if($searchEstado==='RECHAZADO')
                     <option value='RECHAZADO' selected>RECHAZADO</option>
                     <option value=''>Estado Auditoria</option>
                     <option value='PENDIENTE ENVIO PAGARE'>PENDIENTE ENVIO PAGARE</option>
                     <option value='PAGARE ENVIADO'>PAGARE ENVIADO</option>
                     <option value='AUTORIZADO'>AUTORIZADO</option>
                     <option value='GENERADO'>GENERADO</option>           
                @elseif($searchEstado==='AUTORIZADO')
                     <option value='AUTORIZADO' selected>AUTORIZADO</option>
                     <option value=''>Estado Auditoria</option>
                     <option value='GENERADO'>GENERADO</option>
                     <option value='PAGARE ENVIADO'>PAGARE ENVIADO</option>
                     <option value='PENDIENTE ENVIO PAGARE'>PENDIENTE ENVIO PAGARE</option>
                     <option value='RECHAZADO'>RECHAZADO</option>  
                @elseif($searchEstado==='PAGARE ENVIADO')
                     <option value='PAGARE ENVIADO' selected>PAGARE ENVIADO</option>
                     <option value=''>Estado Auditoria</option>
                     <option value='AUTORIZADO'>AUTORIZADO</option>
                     <option value='GENERADO'>GENERADO</option>  
                     <option value='PENDIENTE ENVIO PAGARE'>PENDIENTE ENVIO PAGARE</option>
                     <option value='RECHAZADO'>RECHAZADO</option>   
                @elseif($searchEstado==='PENDIENTE ENVIO PAGARE')
                     <option value='PENDIENTE ENVIO PAGARE' selected>PENDIENTE ENVIO PAGARE</option>
                     <option value=''>Estado Auditoria</option>
                     <option value='AUTORIZADO'>AUTORIZADO</option>
                     <option value='GENERADO'>GENERADO</option>  
                     <option value='PAGARE ENVIADO'>PAGARE ENVIADO</option> 
                     <option value='RECHAZADO'>RECHAZADO</option>   
                @elseif($searchEstado==='GENERADO')
                    <option value='GENERADO' selected>GENERADO</option>
                    <option value=''>Estado Auditoria</option>
                    <option value='AUTORIZADO'>AUTORIZADO</option>
                    <option value='PAGARE ENVIADO'>PAGARE ENVIADO</option>
                    <option value='PENDIENTE ENVIO PAGARE'>PENDIENTE ENVIO PAGARE</option>
                    <option value='RECHAZADO'>RECHAZADO</option> 
                @else
                    <option value='' selected>Estado Auditoria</option>
                    <option value='GENERADO'>GENERADO</option>
                    <option value='AUTORIZADO'>AUTORIZADO</option>
                    <option value='PAGARE ENVIADO'>PAGARE ENVIADO</option>
                    <option value='PENDIENTE ENVIO PAGARE'>PENDIENTE ENVIO PAGARE</option>
                    <option value='RECHAZADO'>RECHAZADO</option>   
                @endif
                </select>     
            </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <select name='searchEjecutivo2' class="form-control">
                    @if ($nombre=='')
                    <option value='Seleccionar'>Ejecutivo</option>
                        @else
                    <option value='{{$searchEjecutivo2}}'>{{$nombre}}</option>
                     <option value='Seleccionar'>Ejecutivo</option>
                         @endif  
                         @foreach ($searchEjecutivo as $eje)
                            <option value='{{$eje->id}}-{{$eje->nombre}}'>{{$eje->nombre}}</option>
                         @endforeach
                    </select>
                </div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
		<span class="input-group-btn">
        <button type="submit" class="btn btn-primary">Buscar</button><br>
      	</span>
            
			</div>
		</div>
<div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <input type="text" class="form-control datepicker"  name="searchFecha1v" placeholder="Fecha Vigente Inicial..." value="{{$searchFecha1v}}">
        </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <input type="text" class="form-control datepicker"  name="searchFecha2v" placeholder="Fecha Vigente Final..." value="{{$searchFecha2v}}">
            </div>
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <select name='searchPagare' class="form-control"> 
                      @if($searchPagare==='SI')
                     <option value='SI' selected>SI</option>
                     <option value='NO'>NO</option>
                     <option value='Seleccionar'>Pagare Firmado</option>
                      @elseif($searchPagare==='NO')
                     <option value='NO' selected >NO</option>
                     <option value='SI' >SI</option>
                     <option value='Seleccionar'>Pagare Firmado</option>
                      @else
                     <option value='Seleccionar' selected>Pagare Firmado</option>
                     <option value='SI'>SI</option>  
                     <option value='NO'>NO</option>
                      @endif
                    
                </select>     
            </div>
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label class="checkbox-inline"><input type="checkbox" name="exp" id="exp" value="1">
        Exportar a Excel</label>           
            </div>
</div>
</div>
{{Form::close()}}
  





  {!! Form::open(array('url'=>'/desloguear','method'=>'POST','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group" style="padding-left: 10px; padding-right:40px;">
        <div class="row">
            <div class="col-md-2 col-sm-12 col-xs-12">
            <input type="text" class="form-control" id="pin" name="pin" placeholder="PIN..." >
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12">
        <span class="input-group-btn">
        <button type="submit" class="btn btn-primary">Desloguear</button>
        </span> 
            </div>
        </div>

</div>
{{Form::close()}}
  