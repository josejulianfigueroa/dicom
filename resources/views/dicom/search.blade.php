{!! Form::open(array('url'=>'/dicom','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group" style="padding-left: 10px;">
		<input type="text" class="form-control"  name="searchText" placeholder="Ingrese el Rut o Nombre..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>
{{Form::close()}}