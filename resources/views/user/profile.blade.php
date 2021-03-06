@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>Dashboard
            <small>
                Estadísticas del mes
            </small>
        </h1>
        <p class="label label-primary">{{Auth::user()->balance}}</p>
        <span class="label label-success">+ {{$earnings['gastostotales']}}</span>
        <span class="label label-danger">- {{$expenses['gastostotales']}}</span>
    </div>
    <div class="col-xs-12 col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Dashboard</h3>
            </div>
            <div class="panel-body">
                <div class="col-xs-6 col-sm-3">
                    <h3>Saldo: {{Auth::user()->balance}}</h3>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <h3>Gastos en el mes: {{$expenses['gastostotales']}}</h3>
                    <p {{ $differenceMonths > 0 ? 'class=text-color-red' : 'class=text-color-green'}}>
                        {{$differenceMonths}} $ {{$differencePercentMonths}} %
                    </p>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <h3>Ingresos en el mes: {{$earnings['gastostotales']}}</h3>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <h3>Ahorros:</h3>
                    @foreach(Auth::user()->savings->all() as $savingsofuser)
                    <h4> {{ $savingsofuser->title }}: {{$savingsofuser->amount}}</h4>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div id="charts" class="col-xs-12 col-sm-4">
        <!-- Aquí se inserta el chart de Google -->
    </div>
</div>

<script type="text/javascript">
    google.load('visualization', '1.0', {'packages': ['corechart']});
            @if ($categoriessexpenses != null)
            google.setOnLoadCallback(drawChart);
            @endif

            function drawChart() {

            var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Category');
                    data.addColumn('number', 'Amount');
                    var rows = new Array();
                    @if ($categoriessexpenses != null)
                    @foreach($categoriessexpenses as $categoryexpense)
                    rows.push(["{{$categoryexpense->slug}}", {{$categoryexpense->amount}}]);
                    @endforeach
                    @endif
                    data.addRows(rows);
                    // Set chart options
                    var options = {
                    title: 'Gastos',
                            width: 400,
                            height: 300,
                            pieHole: 0.4,
                    };
                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById('charts'));
                    chart.draw(data, options);
            }
</script>


@stop