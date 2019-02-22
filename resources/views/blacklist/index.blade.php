
@extends('materialdesign.mastermaterial')
@section('title', 'Ver Blacklist')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Blacklist </h2>
                </div>
                @if (session('status'))
            <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
            @endif
                @if ($black->isEmpty())
                    <p> No hay Ruts en la Blacklist.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;">ID_Cliente</th>
                                <th style="text-align: center;">Rut</th>
                                <th style="text-align: center;">Fono</th>
                                <th style="text-align: center;">Motivo</th>
                            </tr>
                        </thead>
                        <tbody>
            @foreach($black as $blacka)
            <tr>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{!! $blacka->idcliente !!} </td>
        <td><a href="{!! action('BlacklistController@show',$blacka->rut) !!}">{!! $blacka->rut !!}</a></td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{!! $blacka->fono !!}</td>
                <td style="height: 0px; padding-top: 0; padding-bottom: 0;margin-bottom: 0; margin-top: 0;">{!! $blacka->motivo !!}</td>
            </tr>
            @endforeach
                        </tbody>
                    </table>
                    {!!$black->render()!!}
                @endif
            </div>
    </div>

@endsection