@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <div class="pull-right">
            <a href="/earnings/create" class="btn btn-success">Agregar ingreso</a>
        </div>
        <h1>Lista de ingresos</h1>
    </div>
    <div class="col-sm-12">
        <table class="table table-bordered table-hover table-condensed table-responsive">
            <thead>
                <tr>
                    <td>Fecha</td>
                    <td>Amount</td>
                    <td>Description</td>
                    <td>Categoría</td>
                </tr>
            </thead>
            <tbody>
                @foreach($earnings as $earning)
                <tr>
                    <td>{{$earning->date}}</td>
                    <td>{{$earning->amount}}</td>
                    <td>{{$earning->description}}</td>
                    <td>{{$earning->earningscategories->slug}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop