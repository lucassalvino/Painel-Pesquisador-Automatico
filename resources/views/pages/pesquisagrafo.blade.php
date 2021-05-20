@extends('layouts.admin')
@section('title', 'Pesquisa em grafo')


@section('content')

<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h3 class="text-secondary">Pesquisa em grafo</h3>
    </div>
    <div class="d-flex w-100 flex-column">
        <div class="d-flex w-100 pt-3 pb-4">
            <div class="input-group">
                <input type="text" class="form-control" style="height: 45px;" placeholder="Termo de busca">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button" id="busca">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div id="containerdiagrama" style="flex-grow: 1; height: 750px; background-color: #282c34;"></div>
        </div>
    </div>
</div>

@stop