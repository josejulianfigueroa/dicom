<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
			<a class="navbar-brand" href="/">SICCE 2</a>
		</div>
		<!-- Navbar Right -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li class="active">
							<a href="{!!URL::to('/')!!}">
								<i class="fa fa-home fa-fw" aria-hidden="true"></i>
									&nbsp;&nbsp;Inicio
							</a>
				</li>
				@if(Session::has('nombre'))
				<!--
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Blacklist
				<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{!!URL::to('/blacklist_create')!!}">Cargar Rut</a></li>
					<li><a href="{!!URL::to('/blacklist')!!}">Ver Blacklist</a></li>
				</ul>
				</li>-->
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="fas fa-dollar-sign"></i>
									&nbsp;&nbsp;Grabación Seguro
							<span class="caret"></span>
							</a>
					<ul class="dropdown-menu" role="menu">
							<li style="text-align: center;" >
							<!--<a href="{!!URL::to('/pagos')!!}">
								<i class="fas fa-archive"></i>-->
	{!! Form::open(array('url'=>'/gra','method'=>'POST','files'=>'true'))!!}
            {{Form::token()}}
                     <input type="text"  class="form-control" style="text-align: center;" name="rut_graba" id="rut_graba" placeholder="Rut...">          
      			<br>
      					<input type="file" name="imagen" id="form-file" style="background: grey;">    
                       <button  class="btn btn-primary " name="subir_gra" id ="subir_gra" type="submit">Subir Grabacion</button>
   					{{Form::close()}}
						</li>

				    </ul>
				</li>




						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="fas fa-dollar-sign"></i>
									&nbsp;&nbsp;PAGOS
							<span class="caret"></span>
							</a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="{!!URL::to('/pagos')!!}">
								<i class="fa fa-book" aria-hidden="true"></i>
									&nbsp;&nbsp;Consultar Rut
							</a>
						</li>
						@if(Session::get('rol') > 1)
							<li style="text-align: center;" >
							<!--<a href="{!!URL::to('/pagos')!!}">
								<i class="fas fa-archive"></i>-->
	{!! Form::open(array('url'=>'/pagos','method'=>'POST','autocomplete'=>'off','role'=>'searche','id'=>'form_pago2')) !!}
            
                     <input type="text"  class="form-control datepicker" style="text-align: center;" name="fecha_caja_buscar" id="fecha_caja_buscar" placeholder="Fecha a Buscar...">
     
        <label class="checkbox-inline"><input type="checkbox" name="exp" id="exp" value="1">
        Exportar a Excel</label>           
      
                       <button  class="btn btn-primary " name="fecha_caja1" value="1" id ="fecha_caja1" type="submit">Abrir</button>
   					{{Form::close()}}

						<!--	</a>-->
						</li>
						@endif
				    </ul>
				</li>
				@if(Session::get('rol') > 1)
				<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="fa fa-address-card" aria-hidden="true"></i>
									&nbsp;&nbsp;DICOM
							<span class="caret"></span>
							</a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="{!!URL::to('/dicom')!!}">
								<i class="fa fa-book" aria-hidden="true"></i>
									&nbsp;&nbsp;Consultar Lista DICOM
							</a>
						</li>
						<li>
							<a href="{!!URL::to('/aclarar')!!}">
								<i class="fa fa-list" aria-hidden="true"></i>
									&nbsp;&nbsp;Consultar Lista para Aclarar
							</a>
						</li>
				    </ul>
				</li>
				@endif
				@if(Session::get('rol') > 1)
				<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="fas fa-address-book"></i>
									&nbsp;&nbsp;Convenios
							<span class="caret"></span>
							</a>
					<ul class="dropdown-menu" role="menu">
					<!--	<li>
							<a href="{!!URL::to('/dicom')!!}">
								<i class="fa fa-check" aria-hidden="true"></i>
									&nbsp;&nbsp;Convenios por Autorizar
							</a>
						</li>
						<li>
							<a href="{!!URL::to('/dicom')!!}">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
									&nbsp;&nbsp;Convenios Rechazados
							</a>
						</li>-->
						<li>
							<a href="{!!URL::to('/convenios')!!}">
								<i class="fa fa-list" aria-hidden="true"></i>
									&nbsp;&nbsp;Lista Completa de Convenios
							</a>
						</li>
						
				    </ul>
				</li>
				@endif
				@endif
				<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;	
				@if(Session::has('nombre'))
				 		{{Session::get('nombre')}}
				@else
				 		Usuario
				@endif
							<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
				@if(Session::has('nombre'))
							<li>
								<a href="{!!URL::to('/logout')!!}"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Logout</a>
							</li>
						</ul>
				 @else
							<li>
								<a href="{!!URL::to('/log')!!}"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Login</a>
							</li>
						</ul>
				 @endif					
				</li>
			</ul>
		</div>
	</div>
</nav>