@extends('materialdesign.mastermaterial')
@section('title', 'Mostart un Rut en Blacklist')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
            <div class="content">
                <h2 class="header">Detalle del Registro</h2>
                <p><strong>Motivo</strong>:{!! $black->rut !!}</p>
                <p><strong>Motivo</strong>:{!! $black->motivo !!}</p>
                <p><strong>Fono</strong>:{!! $black->fono !!}</p>
            </div>
            <a class="btn btn-info" href="{!! action('BlacklistController@edit',$black->rut) !!}">Editar</a>
            <a class="btn btn-warning" href="{!! action('BlacklistController@destroy',$black->rut) !!}">Borrar</a>
        </div>
    </div>
@endsection