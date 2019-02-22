{!! Form::open(array('url'=>'/pagos','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group" style="padding-left: 170px; padding-top: 10px; padding-bottom: 0px;">
		<div class="row" id="noprint1">
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            @if ($busqueda_cliente !='')
            <select name='busqueda_cliente' class="form-control"> 
                         @foreach ($busqueda_cliente as $eje2)
                        <option value='{{$eje2->idcliente}}'>{{$eje2->nombre_cli}}</option>
                         @endforeach
             </select>
            
             @endif
                </div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">   
			<input type="text" onkeyUp="return ValNumero(this);" class="form-control"  name="searchText" placeholder="Rut..." value="{{$searchText}}">
            </div>
 
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<span class="input-group-btn">
        <button type="submit" class="btn btn-primary">Buscar</button>

        

        @if ($nombre != '') 
        <button type="button" id="imprimir_estado" class="btn btn-primary">Imprimir Estado de Cuenta</button>
        @endif 
      	</span>   
        </div>
        
        <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label class="checkbox-inline"><input type="checkbox" name="exp" id="exp" value="1">
        E</label>           
        </div>-->
		</div> 
        @if ($busqueda_cliente !='')
            <div class="row" id="noprint4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
Este cliente posee convenios con más de un cliente, por favor seleccione el cliente que desea consultar</div></div>  @endif 

</div>
{{Form::close()}}
  