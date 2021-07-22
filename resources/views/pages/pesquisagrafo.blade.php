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
                <input type="text" id="termo-busca" class="form-control" style="height: 45px;" placeholder="Termo de busca">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button" id="busca">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div id="containerdiagrama" style="flex-grow: 1; height: 750px; ">
                <div id="canvas" style="flex-grow: 1; height: 750px; "></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#busca").on("click", function(){
            let url = '{{route("busca-verticearesta-artigo")}}';
            var renderer = null;
            $.ajax({
                url: url,
                data: {
                    busca: $("#termo-busca").val()
                },
                dataType: 'JSON',
                type: "POST",
                headers:{
                    'Authorization':"{{session('Authorization','')}}"
                },
                success: function(result){
                    console.log(result);
                    var g = new Dracula.Graph();
                    var layouter = new Dracula.Layout.Spring(g);
                    for(let i = 0; i<result.length; i++){
                        g.addEdge(result[i].origem, result[i].destino);
                    }
                    layouter.layout();
                    renderer = new Dracula.Renderer.Raphael(document.getElementById('canvas'), g, 888, 750);
                    renderer.draw();
                }
            });
        });
    });
</script>
@stop