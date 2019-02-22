
@extends('materialdesign.mastermaterial')
@section('title', 'Ver Grabaciones')
@section('content')
<br><br>
			@if($cod == '1')
            <div class="alert alert-danger alert-dismissable" style="margin-left: 20px; margin-right: 20px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $status }}
            </div>
            @endif
            @if($cod == '0')
            <div class="alert alert-success alert-dismissable" style="margin-left: 20px; margin-right: 20px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $status }}
            </div>
            <br>
             <div class="alert alert-success alert-dismissable" style="margin-left: 20px; margin-right: 20px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               Su codigo de renuncia es:  {{ $codigo_usuario }}
            </div>
            @endif
          
@endsection