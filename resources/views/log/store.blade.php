@extends('materialdesign.mastermaterial')
@section('title', 'Login')

@section('content')
<div class="container col-md-4 col-md-offset-4">
   <div class="well well bs-component">
		 <fieldset>
  		 <legend>Login</legend>
				{!!Form::open(['method'=>'POST'])!!}
				@if(Session::has('message-error'))
				<div class="alert alert-danger alert-dismissible" role="alert">
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  				{{Session::get('message-error')}}
				</div>
				@endif

				   	<div class="row form-group">
                       <label for="usuario" class="col-lg-3 control-label">Usuario: </label>
 					<div class="col-lg-9">
                        {!!Form::text('usuario',null,['class'=>'form-control','placeholder'=>'Ingrese su Ususario'])!!}
                   </div>
                    </div>
                        <div class="row form-group">
                       <label for="password" class="col-lg-3 control-label">Contraseña: </label>
                        <div class="col-lg-9"> 
                         <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese su Password">
                       
              			 </div>
                    </div>
					<div class="form-group">
                        <div class="col-lg-10 col-lg-offset-8">
							{!!Form::submit('Entrar',['class'=>'btn btn-primary'])!!}
                        </div>
                    </div>
				{!!Form::close()!!}
				{!!link_to('password/email', $title = 'Olvidaste tu contraseña?', $attributes = null, $secure = null)!!}
		</fieldset>
	</div>
</div>
@endsection