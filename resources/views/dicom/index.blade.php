
@extends('materialdesign.mastermaterial')
@section('title', 'Ver Lista DICOM')
@section('content')

    <div class="container col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Lista DICOM </h2>
                </div>
            @if (session('status'))
            <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
            @endif
            @include('dicom.search')

                @if ($lista->isEmpty())
                    <p>No hay Ningún registro en la lista DICOM</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Cliente</th>
                                <th style="text-align: center;">Rut</th>
                                <th style="text-align: center;">Dv</th>
                                <th style="text-align: center;">Apellido Pat.</th>
                                <th style="text-align: center;">Nombres</th>
                                <th style="text-align: center;">Monto Prot.</th>
                                <th style="text-align: center;">Fecha Venc.</th>
                                <th style="text-align: center;">Fecha Prot.</th>
                                <th style="text-align: center;">N° Docum.</th>
                                <th style="text-align: center;">Situación</th>
                                <th style="text-align: center;">Fecha Aclarac.</th>
                                <th style="text-align: center;">Opción</th>
                            </tr>
                        </thead>
                        <tbody>
            @foreach($lista as $lis)
            <tr>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">@if ($lis->idcliente === 60) Presto 
                         @elseif ($lis->idcliente === 84) Eficaz
                         @elseif ($lis->idcliente === 83) Wallmart
                    @else Santander
                    @endif </td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->rut }}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->dv }}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->apellido_pat }}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->nombres }}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->monto_protesto }}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->fecha_vencimiento }}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->fecha_protesto }}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->numero_documento }}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->situacion }}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{{ $lis->fecha_aclaracion }}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;"><a href="{{URL::action('DicomListaController@edit',$lis->id)}}"><button class="btn btn-info">Editar</button></a></td>
            </tr>

            @endforeach
                        </tbody>
                    </table>
               
                      {{$lista->appends(Request::input())->links() }}
                @endif
            </div>
    </div>

@endsection