@extends('templates.master')
@section('header')
@parent
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="page-header">
                <h1>{{ $user->name }} {{ $user->lastname }}
                    <small>
                        {{ $user->username }}
                    </small>
                </h1>
            </div>
        </div>
    </div>
    <div class="row">
        
    </div>
</div>
@stop