@extends('materialdesign.mastermaterial')
@section('title', 'Home')
@section('content')
<?php
   include(app_path().'/includes/notificaciones.php');
   echo mensaje_bienvenida(); 
 ?>

<div class="container">
	<div class="row banner">
		<div class="col-md-12">
			<div class="text-center"><br></br></div>
				<div class="text-center"><br></br></div>
					<div class="text-center"><br></br></div>
			<h1 class="text-center margin-top-100 editContent">
			“Sólo triunfa en el mundo quién se levanta y busca a las circunstancias y las crea si no las encuentra”. George Bernard Shaw
			</h1>
			<div class="text-center"><br></br></div>
			<h3 class="text-center margin-top-100 editContent">Bienvenido</h3>
				<div class="text-center">
					
				</div>
			</div>
		</div>
	</div>
@endsection