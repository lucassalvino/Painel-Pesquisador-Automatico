@extends('layouts.admin')
@section('title', 'Artigos')

@section('content')
<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h3 class="text-secondary">Cadastro de artigo externo</h3>
    </div>
    <div class="d-flex w-100">
        <form class="w-100" action="{{route('cadastra-artigo')}}" method="POST" 
            enctype="multipart/form-data" data-onsubmit data-reload data-Authorization="{{session('Authorization','')}}">
            <div class="d-flex w-100">
                <div class="form-group w-50">
                    <label for="file-photo">Arquivo</label>
                    <input type="file" class="form-control" id="file-photo" required>
                    <input type="hidden" name="arquivo_base_64" id="path-photo">
                    <input type="hidden" name="arquivo_tipo" id="type-photo">
                </div>
                <div class="form-group w-50 ml-2">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Título" required>
                </div>
            </div>
            <div class="d-flex w-100 pt-1">
                <div class="form-group w-50">
                    <label for="ano">Ano</label>
                    <input type="number" value="2020" name="ano" id="ano" placeholder="Ano Publicação" required>
                </div>
                <div class="form-group w-50 ml-2">
                    <label for="idioma">Idioma</label>
                    <select name="idioma_id" id="idioma">
                        @foreach($idiomas as $idioma)
                        <option value="{{$idioma->id}}">{{$idioma->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex w-100 pt-1">
                <div class="form-group w-100">
                    <label for="autor">Autor</label>
                    <input type="text" name="autor" id="autor" placeholder="Autor ou Autores" maxlength="300" required>
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
        <h4 class="text-secondary">Artigos Cadastrados</h4>
    </div>
    <div class="d-flex w-100">
        <div class="row w-100">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Ano</th>
                        <th>Data</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artigos as $artigo)
                        <tr>
                            <td>{{$artigo['titulo']}}</td>
                            <td>{{$artigo['ano']}}</td>
                            <td>{{$artigo['data']}}</td>
                            <td align="left">
                                <div class="d-flex opcoes-table-view">
                                    <a href="{{$artigo['path_arquivo']}}" target="_blank">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a href="{{$artigo['path_arquivo']}}" download>
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Nenhum cadastrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop