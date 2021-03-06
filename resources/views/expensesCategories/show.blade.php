@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <div class="pull-left">
            <a href="{{ URL::previous() }}" class="btn btn-warning">Regresar</a>
        </div>
        <div class="pull-right">
            <a href="/categories/expenses/{{$expensesCategory->id}}/edit" class="btn btn-info">Editar categoría</a>
        </div>
        <h1 class="">Gastos de {{$expensesCategory->slug}} <small>Desde {{$date1}} hasta {{$date2}}</small></h1>
    </div>
    <div id="table-container" class="col-sm-12">
        <div class="col-xs-12 col-sm-10 col-sm-offset-2">
            <form action="/categories/expenses/{{$expensesCategory->id}}/reports" method="POST" class="form-inline">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <div class="form-group">
                    Gastos Desde <input type="date" value="{{$date1}}" placeholder="Fecha" name="date1" id="date1" class="form-control">
                    hasta <input type="date" value="{{$date2}}" placeholder="Fecha" name="date2" id="date2" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cambiar">
                </div>
            </form>
        </div>
        <table class="table table-bordered table-hover table-condensed table-responsive">
            <thead>
                <tr>
                    <td>Fecha</td>
                    <td>Monto</td>
                    <td>Descripción</td>
                    <td>Categoría</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr>
                    <td>{{$expense->date}}</td>
                    <td>{{$expense->amount}}</td>
                    <td>{{$expense->description}}</td>
                    <td>{{$expense->expensescategories->slug}}</td>
                    <td>
                        <form id="delete-earning" action="/expenses/{{$expense->id}}" method="POST" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Eliminar"
                                   data-container="body"
                                   data-toggle="popover"
                                   data-placement="left"
                                   data-content="Popover"
                                   data-trigger="hover">
                            <a href="/expenses/{{$expense->id}}/edit" class="btn btn-info">
                                Editar
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>Total:</td>
                    <td>{{$totalexpenses}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop