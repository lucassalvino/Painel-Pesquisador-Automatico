<div class="w-100 containererro" style="display: none;">
    <div class="d-flex w-100 justify-content-start align-items-start errorlist pb-3 flex-column">
        @if(array_key_exists('mensagem', $retorno))
            <h6 class="text-danger"> {{$retorno['mensagem']}} </h6>
        @endif
        @if(array_key_exists('mensagenserro', $retorno) && count($retorno['mensagenserro']) > 0)
            <ul class="list-group w-100">
                @forelse($retorno['mensagenserro'] as $descricaoErro)
                    <li class="w-100 mb-2 list-group-item list-group-item-danger">{{$descricaoErro}}</li>
                @empty
            </ul>
            @endforelse
        @endif
    </div>
</div>

<script>
    $('.containererro').show('slow');
</script>