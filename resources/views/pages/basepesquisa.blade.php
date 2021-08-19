@extends('layouts.admin')
@section('title', 'Bases de Pesquisas')

@section('content')
<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h3 class="text-secondary">Base de Pesquisas</h3>
    </div>
    <div class="d-flex w-100">
        <form class="w-100" action="{{route('cadastra-base-pesquisa')}}" method="POST" 
            enctype="multipart/form-data" data-onsubmit data-reload data-Authorization="{{session('Authorization','')}}">
            <div class="d-flex w-100">
                <div class="form-group w-50 ml-2">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" id="descricao" placeholder="Descrição" maxlength="300" required>
                </div>
            </div>
            <div class="d-flex w-100 justify-content-end pt-4">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary"> Cadastrar </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="d-flex w-100 flex-column mt-3">
    <div class="d-flex">
        <h4 class="text-secondary">Bases Cadastrados</h4>
    </div>
    <div class="d-flex w-100">
        <div class="row w-100">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>Descricão</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bases as $base)
                        <tr>
                            <td>{{$base['descricao']}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="1">Nenhum cadastrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop