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
            var load = Swal.fire({
                title: 'Aguarde...',
                html: '<div class="lds-hourglass"></div>',// add html attribute if you want or remove
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            let url = '{{route("busca-verticearesta-artigo")}}';
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
                    var conjunto = new Set();
                    var vertices = [];
                    var arestas = [];
                    for(let i = 0; i < result.length; i++){
                        if(!conjunto.has(result[i].origem_id)){
                            vertices.push({
                                id: result[i].origem_id, 
                                label: result[i].origem
                            });
                            conjunto.add(result[i].origem_id);
                        }
                        if(!conjunto.has(result[i].destino_id)){
                            vertices.push({
                                id: result[i].destino_id, 
                                label: result[i].destino
                            });
                            conjunto.add(result[i].destino_id);
                        }
                        arestas.push({
                            from: result[i].origem_id,
                            to: result[i].destino_id,
                            label: result[i].conexao
                        });
                    }
                    var container = document.getElementById("canvas");
                    var nodes = new vis.DataSet(vertices);
                    var edges  = new vis.DataSet(arestas);
                    var data = {
                        nodes: nodes,
                        edges: edges,
                    };
                    var options = {
                        physics:{
                            enabled: false
                        }
                    };
                    var network = new vis.Network(container, data, options);
                    load.close();
                }
            });
        });
    });
</script>
@stop