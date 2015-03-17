@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>Agregar un ahorro</h1>
    </div>
    <div class="col-sm-12">
        @if($errors->savingsError->first() != null)
        <div class="alert alert-warning" role="alert">
            {{ $errors->savingsError->first() }}
        </div>
        @endif
        <form action="/savings" method="POST" class="form" accept-charset="UTF-8">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="amount">Monto inicial:</label>
                <input class="form-control" type="text" pattern="[0-9]*(.[0-9]+|)" id="amount" name="amount" placeholder="Monto"/>
            </div>
            <div class="form-group">
                <label for="description">Título:</label>
                <input class="form-control" type="text" id="title" name="title" placeholder="Título"/>
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <input class="form-control" type="text" id="description" name="description" placeholder="Descripción"/>
            </div>
            <div class="form-group">
                <input class="btn btn-success" type="submit" value="Agregar"/>
                <a href="{{ URL::previous() }}" class="btn btn-warning">Regresar</a>
            </div>
        </form>
    </div>
</div>

@stop