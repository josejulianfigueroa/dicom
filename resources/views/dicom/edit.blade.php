@extends('materialdesign.mastermaterial')
@section('title', 'Editar Rut Lista DICOM')

@section('content')
<div class="container col-md-12 col-md-offset-0">
        <div class="well well bs-component">
   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Registo: {{ $lista->id}}</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
            </div>
    </div>

            {!!Form::model($lista,['method'=>'PATCH','route'=>['dicom.update',$lista->id]])!!}
              {{Form::token()}}
        <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <label for="rut">Rut:</label>
        <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
             <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
             <input type="text" name="rut" class="form-control" readonly  value="{{$lista->rut}}">
             </div>
             <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"><label for="dv">dv</label>
             </div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                 <input type="text" name="dv" class="form-control" readonly  value="{{$lista->dv}}">
                 <!--   <select name='dv' readonly class="form-control">
                    <option value='{{$lista->dv}}'>{{$lista->dv}}</option>
                    <option value='0'>0</option>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                    <option value='6'>6</option>
                    <option value='7'>7</option>
                    <option value='8'>8</option>
                    <option value='9'>9</option>
                    <option value='k'>k</option>
                    </select>-->
            </div>
        </div>
    </div>              
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="nombre">Nombres</label>
                <input type="text" name="nombres" class="form-control"  value="{{$cli->nombres}}" placeholder="Nombres...">
            </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="apellido_pat">Apellido Paterno</label>
                <input type="text" name="apellido_pat" class="form-control"  value="{{$cli->apellido_pat}}" placeholder="Apellido Paterno">
            </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="apellido_mat">Apellido Materno</label>
                <input type="text" name="apellido_mat" class="form-control"  value="{{$cli->apellido_mat}}" placeholder="Apellido Materno">
            </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
     <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="idcliente">Cliente</label>
        <!-- <select name='idcliente' readonly class="form-control">
             @if($lista->idcliente=='60')
                    <option value='60' selected>Presto</option>
                    <option value='83'>Walmart</option>
                    <option value='68'>Santander</option>
                    <option value='84'>Eficaz</option>
             @elseif($lista->idcliente=='68')
                    <option value='68' selected>Santander</option>
                    <option value='60' >Presto</option>
                    <option value='83'>Walmart</option>
                    <option value='84'>Eficaz</option>
             @elseif($lista->idcliente=='83')
                    <option value='83' selected>Walmart</option>
                    <option value='68' >Santander</option>
                    <option value='60' >Presto</option>
                    <option value='84'>Eficaz</option>
            @else
                    <option value='84' selected>Eficaz</option>
                    <option value='83' >Walmart</option>
                    <option value='68' >Santander</option>
                    <option value='60' >Presto</option>      
            @endif

         </select>-->
           @if($lista->idcliente=='60')
            <input type="text" name="idcliente" class="form-control" readonly value="Presto">
             @elseif($lista->idcliente=='68')
             <input type="text" name="idcliente" class="form-control" readonly value="Santander">
             @elseif($lista->idcliente=='83')
             <input type="text" name="idcliente" class="form-control" readonly value="Walmart">
            @else
             <input type="text" name="idcliente" class="form-control" readonly value="Eficaz">
            @endif
            </div>
    </div>
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="monto_protesto">Monto Protesto:</label>
                <input type="text" name="monto_protesto" class="form-control"  value="{{$lista->monto_protesto}}" placeholder="monto_protesto...">
            </div>
    </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="moneda">Moneda</label>
                    <select name='moneda' class="form-control">
                    <option value='{{$lista->moneda}}'>{{$lista->moneda}}</option>
                    <option value='PESO'>PESO</option>
                    <option value='UNIDAD DE FOMENTO'>UNIDAD DE FOMENTO</option>
                    <option value='UNIDAD TRIBUTARIA MENSUAL'>UNIDAD TRIBUTARIA MENSUAL</option>
                    <option value='INDICE DE VALOR PROMEDIO'>INDICE DE VALOR PROMEDIO</option>
                    <option value='DOLAR USA'>DOLAR USA</option>
                    <option value='EURO'>EURO</option>
                    </select>
            </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="fecha_vencimiento">Fecha Vencimiento</label>
                <input type="text" name="fecha_vencimiento" class="form-control datepicker"  value="{{$lista->fecha_vencimiento}}" >
            </div>
    </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="fecha_protesto">Fecha Protesto</label>
                <input type="text" name="fecha_protesto" class="form-control datepicker"  value="{{$lista->fecha_protesto}}" >
            </div>
    </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="numero_documento">N° Documento</label>
                <input type="text" name="numero_documento" class="form-control"  value="{{$lista->numero_documento}}" >
            </div>
    </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="situacion">Situación</label>
                <select name='situacion' class="form-control">
               @if($lista->situacion==='EN DICOM')
                    <option value='EN DICOM' selected>EN DICOM</option>
                    <option value='ACLARADO'>ACLARADO</option>
                    <option value='PRESCRITO'>PRESCRITO</option>
                    <option value='ENVIADO A ACLARAR'>ENVIADO A ACLARAR</option> 
                @elseif($lista->situacion==='ACLARADO')
                     <option value='ACLARADO' selected>ACLARADO</option>
                     <option value='EN DICOM'>EN DICOM</option>
                     <option value='PRESCRITO'>PRESCRITO</option>
                     <option value='ENVIADO A ACLARAR'>ENVIADO A ACLARAR</option> 
                @elseif($lista->situacion==='PRESCRITO')
                     <option value='PRESCRITO' selected>PRESCRITO</option>
                     <option value='ACLARADO'>ACLARADO</option>
                     <option value='EN DICOM'>EN DICOM</option>  
                     <option value='ENVIADO A ACLARAR'>ENVIADO A ACLARAR</option>   
                @else
                     <option value='ENVIADO A ACLARAR' selected>ENVIADO A ACLARAR</option>
                     <option value='PRESCRITO'>PRESCRITO</option>
                     <option value='ACLARADO'>ACLARADO</option>
                     <option value='EN DICOM'> EN DICOM</option>  
                @endif
                </select>     
            </div>
    </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="fecha_envio_aclaracion">Fecha de Envío a Aclarar</label>
                <input type="text" name="fecha_envio_aclaracion" class="form-control datepicker"  value="{{$lista->fecha_envio_aclaracion}}" >
            </div>
    </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="fecha_aclaracion">Fecha de Aclaración</label>
                <input type="text" name="fecha_aclaracion" class="form-control datepicker"  value="{{$lista->fecha_aclaracion}}" >
            </div>
    </div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                <label for="observacion">Observación</label>
                <input type="text" name="observacion" class="form-control"  value="{{$lista->observacion}}" >
            </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
    
            <div class="form-group" style="padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">
                 <input type="hidden" name="id_cli"  value="{{$cli->id}}">
                <button class="btn btn-primary" type="submit">Actualizar</button>
                <a href="{!!URL::to('/dicom')!!}"><button class="btn btn-danger" type="button">Cancelar</button></a>
            </div>
    
<!--  <fieldset class="fieldset fieldset--demo"><div class="fieldset__wrapper"><input class="fieldset__input js__timepicker" type="text" placeholder="Try me&hellip;"></div></fieldset>-->
    </div>
    </div>
            {!!Form::close()!!}   
</div>
</div> 
@endsection
 