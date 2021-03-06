@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>Crear categoria de Ingresos</h1>
    </div>
    @if($errors->first() != null)
    <div class="alert alert-warning" role="alert">
        {{ $errors->first() }}
    </div>
    @endif
    <form method="POST" action="/categories/earnings" accept-charset="UTF-8">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="slug" class="awesome">Nombre:</label>
            <input class="form-control" required="required" value="{{old('slug')}}" name="slug" type="text" id="slug">
        </div>
        <div class="form-group">
            @if(count($categories) >= 1)
            <label>Categoría superior (opcional)</label>
            <select name="superior_cat" id="superior_cat" value="{{old('superior_cat')}}" class="form-control">
                <option value="-1">Ninguna</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->slug}}</option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="form-group">
            <input class="btn btn-info" type="submit" value="Crear">
            <a href="{{ URL::previous() }}" class="btn btn-danger">Regresar</a>
        </div>
    </form>
</div>

@stop