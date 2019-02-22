{!! Form::open(array('url'=>'/aclarar','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group" style="padding-left: 10px; padding-right:40px;">
		<div class="row">
			<div class="co4-lg-3 col-md-3 col-sm-3 col-xs-12">
		<input type="text" class="form-control datepicker"  name="searchFecha1" placeholder="Fecha Inicio..." value="{{$searchFecha1}}">
		</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<input type="text" class="form-control datepicker"  name="searchFecha2" placeholder="Fecha Fin..." value="{{$searchFecha2}}">
			</div>
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <label class="checkbox-inline"><input type="checkbox" name="exp" id="exp" value="1">
        Exportar a Excel</label>           
            </div>
           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <span class="input-group-btn">
        <button type="submit" class="btn btn-primary">Buscar</button><br>
        </span>
            </div>
</div>
</div>

{{Form::close()}}
  