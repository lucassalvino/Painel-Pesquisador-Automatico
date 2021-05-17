@extends('layouts.admin')
@section('title', 'Home')

@section('content')
<style>
    .card-info{
        min-width: 245px;
        max-width: 245px;
        width: 245px;
        min-height: 145px;
        max-height: 145px;
        height: 145px;
    }
    .card-info i{
        font-size: 45px;
        color: gray;
        padding-right: 10px;
    }
    .border-right{
        margin-right: 10px;
    }
    .numero-valor{
        font-size: 30px;
    }
    .numero-valor-data{
        font-size: 25px;
    }
</style>

<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h3 class="text-secondary">Status</h3>
    </div>
    <div class="d-flex justify-content-center align-items-center flex-wrap w-100">

        <div class="card m-2 card-info ">
            <div class="card-body d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-center border-right">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <p class="text-secondary">Artigos Cadastrados</p>
                    </div>
                    <div class="d-flex w-100 justify-content-center align-items-center">
                        <p class="text-dark numero-valor">{{$homeartigos['artigos']}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card m-2 card-info">
            <div class="card-body d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-center border-right">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <p class="text-secondary">Vértices de conhecimento</p>
                    </div>
                    <div class="d-flex w-100 justify-content-center align-items-center">
                        <p class="text-dark numero-valor">0</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card m-2 card-info">
            <div class="card-body d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-center border-right">
                    <i class="fas fa-spell-check"></i>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <p class="text-secondary">Avaliações de suposições</p>
                    </div>
                    <div class="d-flex w-100 justify-content-center align-items-center">
                        <p class="text-dark numero-valor">0</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card m-2 card-info">
            <div class="card-body d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-center border-right">
                    <i class="far fa-clock"></i>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <p class="text-secondary">Último processamento</p>
                    </div>
                    <div class="d-flex w-100 justify-content-center align-items-center">
                        <p class="text-dark numero-valor numero-valor-data">00/00/0000</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card m-2 card-info">
            <div class="card-body d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-center border-right">
                    <i class="fas fa-question"></i>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <p class="text-secondary">Suposições Pendentes</p>
                    </div>
                    <div class="d-flex w-100 justify-content-center align-items-center">
                        <p class="text-dark numero-valor">0</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card m-2 card-info">
            <div class="card-body d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-center border-right">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <p class="text-secondary">Artigos não processados</p>
                    </div>
                    <div class="d-flex w-100 justify-content-center align-items-center">
                        <p class="text-dark numero-valor">{{$homeartigos['pendentes']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex mt-5">
        <div class="card w-100">
            <div class="card-header">
                <b>Últimos Eventos</b>
            </div>
            <div class="card-body">
                <div class="d-flex" >
                    <div class="col-10">
                        <ul class="timeline">
                            @forelse($eventos as $evento)
                            <li class="timeline-item bg-white rounded ml-3 p-4 shadow">
                                <div class="timeline-arrow"></div>
                                <h2 class="h5 mb-0">{{$evento['titulo']}}</h2>
                                <span class="small text-gray">
                                    <i class="fas fa-history"></i>
                                    {{$evento['data']}}
                                </span>
                                <p class="text-small mt-2 font-weight-light">
                                    {{$evento['descricao']}}
                                </p>
                            </li>
                            @empty
                            <li class="timeline-item bg-white rounded ml-3 p-4 shadow">
                                <div class="timeline-arrow"></div>
                                <h2 class="h5 mb-0">Nenhum evento</h2>
                                <span class="small text-gray">
                                    <i class="fas fa-history"></i>
                                    00/00/0000 00:00:00
                                </span>
                                <p class="text-small mt-2 font-weight-light">
                                    Aguardando eventos a serem exibidos
                                </p>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop