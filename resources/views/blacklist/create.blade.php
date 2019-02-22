@extends('materialdesign.mastermaterial')
@section('title', 'Cargar Blacklist')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
        {!!Form::open(['method'=>'POST','class'=>'form-horizontal'])!!}
      <!--<form class="form-horizontal" method="post">-->
      
               <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            @foreach ($errors->all() as $error)           
            <p class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $error }}</p>
            @endforeach

            @if (session('status'))
            <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
            @endif
                <fieldset>
                    <legend>Registrar Rut en BlackList</legend>
                    <div class="form-group">
                       <label for="rut" class="col-lg-2 control-label">Rut:</label>
                        <div class="col-lg-10">
                        {!!Form::text('rut',null,['class'=>'form-control','placeholder'=>'Ingrese Rut'])!!}
                          <!--  <input type="text" class="form-control" name="rut" id="rut" placeholder="Ingrese Rut">-->
                        
                        </div>
                    </div>
                        <div class="form-group">
                        <!--<label for="motivo" class="col-lg-2 control-label">Motivo</label>-->
                        {!!Form::label('motivo','Motivo:',['class'=>'col-lg-2 control-label'])!!}
                        <div class="col-lg-10">
                            <textarea class="form-control" name="motivo" rows="3" id="motivo"></textarea>
                            <span class="help-block">Motivo del Por qué? va a blacklist</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Cancelar</button>

                            {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
                        <!--    <button type="submit" class="btn btn-primary">Registrar</button>-->
                        </div>
                    </div>
                </fieldset>
           <!-- </form>-->
            {!!Form::close()!!}
        </div>
    </div>
@endsection
