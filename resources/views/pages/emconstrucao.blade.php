@extends('layouts.admin')
@section('title', 'Ainda estou fazendo')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center">
    <div class="d-flex">
        <h1>Estou construindo</h1>
    </div>
    <hr>
    <div class="d-flex">
        <img src="{{asset('assets/images/programming.gif')}}" alt="Estou fazendo">
    </div>
</div>
<style>
    #norris{
        position: absolute;
        right: 0;
        bottom: 0;
        margin-bottom: 10px;
    }
    #norris img{
        width: 70px;
        height: auto;
    }
</style>
@stop