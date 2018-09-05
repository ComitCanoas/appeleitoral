<html>
<head>
    <style>
        .w-100 { width: 100%; }
        .p-5{ padding: 5px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .pull-left { float: left; }
        .pull-right { float: right; }
        .font-bold { font-weight: bold; }
        .bg-secondary { background: #F7F7F7; }
        .bg-gray { background: #CCC; }
        .uppercase { text-transform: uppercase; }
        .border-secondary { border: solid 1px #CCC; }
        .table { width: 100%; border-collapse: collapse; }
        .table td { border: solid 1px #CCC; padding: 5px; }
        .text-success { color: #28a745; }
        .text-danger { color: #DC3545; }
    </style>
</head>
<body>
    <div class="w-100 p-5 text-center bg-secondary border-secondary">
        <small class="pull-left">App Eleitoral</small>
        <small class="pull-right">Consulta: {{ date( 'd/m/Y' , strtotime(now())) }}</small>
        <br>
        <h1 class="uppercase">{{ $cidade->nome }}</h1>
        <small>Gentílico: {{ $cidade->gentilico }}</small>
    </div>
    <div class="w-100 p-5 text-center border-secondary">
        <p class="lead">Cidade de {{ $cidade->nome }} tem uma população de <strong>{{ number_format($cidade->populacao,-3,',','.') }}</strong> pessoas com <strong>{{ number_format($cidade->numero_eleitores,-3,',','.') }}</strong> eleitores.</p>
    </div>

    <br>

    @if($cidade->cidadePolitico->prefeito)
        @php
            $prefeito = $cidade->cidadePolitico->prefeito;
        @endphp
    @endif

    <table class="table">
        <tr class="text-center bg-secondary">
            <td class="font-bold" colspan="2">Prefeito</td>
        </tr>
        <tr>
            <td width="15%" class="font-bold">Nome:</td>
            <td>{{ $prefeito->nome }}</td>
        </tr>
        <tr>
            <td width="15%" class="font-bold">Endereço:</td>
            <td>{{ $prefeito->endereco }}</td>
        </tr>
        <tr>
            <td width="15%" class="font-bold">Email:</td>
            <td>{{ $prefeito->email }}</td>
        </tr>
        <tr>
            <td width="15%" class="font-bold">Telefone:</td>
            <td>{{ $prefeito->telefone }}</td>
        </tr>
    </table>

    <br>

    @if($cidade->cidadePolitico->vicePrefeito)
        @php
            $vicePrefeito = $cidade->cidadePolitico->vicePrefeito;
        @endphp
    @endif

    <table class="table">
        <tr class="text-center bg-secondary">
            <td class="font-bold" colspan="2">Vice-prefeito</td>
        </tr>
        <tr>
            <td width="15%" class="font-bold">Nome:</td>
            <td>{{ $vicePrefeito->nome }}</td>
        </tr>
        <tr>
            <td width="15%" class="font-bold">Endereço:</td>
            <td>{{ $vicePrefeito->endereco }}</td>
        </tr>
        <tr>
            <td width="15%" class="font-bold">Email:</td>
            <td>{{ $vicePrefeito->email }}</td>
        </tr>
        <tr>
            <td width="15%" class="font-bold">Telefone:</td>
            <td>{{ $vicePrefeito->telefone }}</td>
        </tr>
    </table>

    <br>
    
    @if($cidade->cidadePolitico->candidatoPTB)

        @php
            $candidatoPTB = $cidade->cidadePolitico->candidatoPTB;
        @endphp

        <table class="table">
            <tr class="text-center bg-secondary">
                <td class="font-bold" colspan="2">Candidato PTB</td>
            </tr>
            <tr>
                <td width="15%" class="font-bold">Nome:</td>
                <td>{{ $candidatoPTB->nome }}</td>
            </tr>
            <tr>
                <td width="15%" class="font-bold">Endereço:</td>
                <td>{{ $candidatoPTB->endereco }}</td>
            </tr>
            <tr>
                <td width="15%" class="font-bold">Email:</td>
                <td>{{ $candidatoPTB->email }}</td>
            </tr>
            <tr>
                <td width="15%" class="font-bold">Telefone:</td>
                <td>{{ $candidatoPTB->telefone }}</td>
            </tr>
        </table>

        <br>

    @endif

    @foreach($cidade->eleicao as $key => $eleicao)
        <table class="table w-100">
            <tr class="text-center bg-gray">
                <td colspan="4" class="font-bold p-5">Eleição {{ $eleicao->ano_eleicao }}</td>
            </tr>
            @if(count($eleicao->politicoEleicao) > 0)

                @php
                    $cargos = $eleicao->politicoEleicao->groupBy('cargo_id');

                    $agrupadosPorCargo = $cargos->keyBy(function ($value, $key) {
                        $cargo = \App\Entities\Cargo::find($key);
                        return $cargo->nome;
                    })->sortKeys();
                @endphp

                @foreach($agrupadosPorCargo as $cargo => $politicos)
                    <tr class="text-center bg-secondary">
                        <td colspan="4">{{ $cargo }}</td>
                    </tr>
                    <tr class="text-center font-bold">
                        <td>Nome</td>
                        <td>Partido</td>
                        <td>Quantidade de Votos</td>
                        <td>Status</td>
                    </tr>

                    @php
                        //Ordeno políticos por quantidade de votos
                        $ordenaPorVotos = $politicos->sortByDesc('quantidade_votos');

                        //para tab de vereadores: mostrar todos eleitos mais os 3 vereadores mais votados do ptb não eleitos
                        $vereadoresEleitos = $ordenaPorVotos->where('eleito', 'S');
                        $vereadoresNaoEleitosPTB = $ordenaPorVotos->where('eleito', 'N')->where('partido', 'PTB')->take(3);

                        //Adiciono no fim quem são os 3 mais votados do ptb.
                        foreach ($vereadoresNaoEleitosPTB as $ptb){
                            $vereadoresEleitos->push($ptb);
                        }

                        //para tab de deputados
                        $osCincoDeputadosMaisVotados = $ordenaPorVotos->take(5);
                        $deputadosEstaduaisFedereaisEscolhidos = $ordenaPorVotos->whereIn('politico_id', [156839,156467,156564,156392,156594,156179,156218,156649]);

                        //atribuo o tipo de deputado
                        $deputadosEscolhidos = (($cargo == \App\Entities\Cargo::DEPUTADO_FEDERAL) || ($cargo == \App\Entities\Cargo::DEPUTADO_ESTADUAL))
                                        ? $deputadosEstaduaisFedereaisEscolhidos
                                        : collect([]);

                        foreach ($deputadosEscolhidos as $deputado){
                            $osCincoDeputadosMaisVotados->push($deputado);
                        }

                        $ptb = (($cargo == \App\Entities\Cargo::DEPUTADO_FEDERAL) || ($cargo == \App\Entities\Cargo::DEPUTADO_ESTADUAL))
                                ? $osCincoDeputadosMaisVotados
                                : $vereadoresEleitos;

                    @endphp

                    @foreach($ptb as $politicoEleicao)
                        <tr class="text-center {{ (in_array($politicoEleicao->politico->id, [156839,156467,156564,156392,156594,156179,156218,156649])) ? "font-bold" : "" }}">
                            <td>{{ $politicoEleicao->politico->nome }}</td>
                            <td>{{ $politicoEleicao->partido }}</td>
                            <td>{{ number_format($politicoEleicao->quantidade_votos,-3,',','.') }}</td>
                            <td>
                                @if($politicoEleicao->eleito == 'S')
                                    <strong class="text-success">Eleito</strong>
                                @else
                                    <strong class="text-danger">Não eleito</strong>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach

            @else
                <div class="alert alert-info text-center">
                    Não há informações cadastradadas dessa eleição para cidade de {{ $cidade->nome }}
                </div>
            @endif
        </table>
        <br>
    @endforeach

    @if(count($cidade->presidenteCoordenador) > 0)
        <table class="table">
            <tr class="text-center bg-gray font-bold">
                <td colspan="2" class="p-5">Liderança</td>
            </tr>
            @foreach($cidade->presidenteCoordenador as $presidenteCoordenador)
                <tr class="text-center bg-secondary">
                    <td class="font-bold" colspan="2">{{ $presidenteCoordenador->tipo->nome }}</td>
                </tr>
                <tr>
                    <td width="15%" class="font-bold">Nome:</td>
                    <td>{{ $presidenteCoordenador->nome }}</td>
                </tr>
                <tr>
                    <td width="15%" class="font-bold">Endereço:</td>
                    <td>{{ $presidenteCoordenador->endereco }}</td>
                </tr>
                <tr>
                    <td width="15%" class="font-bold">Email:</td>
                    <td>{{ $presidenteCoordenador->email }}</td>
                </tr>
                <tr>
                    <td width="15%" class="font-bold">Telefone:</td>
                    <td>{{ $presidenteCoordenador->telefone }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <br>

    @if(count($cidade->recurso) > 0)

        @php
            $orgaoAuxiliar = "";

            $recursosOrgaos = $cidade->recurso->groupBy('orgao_id');

            $recursos = $recursosOrgaos->keyBy(function ($value, $key) {
                $orgao = \App\Entities\Orgao::find($key);
                return $orgao->nome;
            })->sortKeys();

        @endphp

        <table class="bg-gray w-100">
            <tr class="text-center font-bold">
                <td class="p-5">Recursos</td>
            </tr>
        </table>

        @foreach($recursos as $orgao => $recurso)

                <table class="table">
                    @if($orgaoAuxiliar != $orgao)
                        <tr class="text-center bg-secondary font-bold">
                            <td colspan="5">{{ $orgao }}</td>
                        </tr>
                        <tr class="text-center font-bold">
                            <td>Ano</td>
                            <td>Processo</td>
                            <td>Ação</td>
                            <td>Emenda</td>
                            <td>Valor</td>
                        </tr>
                    @endif

                    @foreach($recurso as $key => $value)
                        <tr class="text-center">
                            <td style="width: 10%;">{{ $value['ano'] }}</td>
                            <td style="width: 20%;">{{ $value['processo'] }}</td>
                            <td style="width: 32%;">{{ $value['acao'] }}</td>
                            <td style="width: 20%;">{{ $value['situacao'] }}</td>
                            <td style="width: 12%;">R$ {{ number_format($value['valor'], 2, ',', '.') }}</td>
                        </tr>
                    @endforeach

                    @if($orgaoAuxiliar != $orgao)
                        <tr class="bg-secondary">
                            <td colspan="4" class="text-right font-bold">Total: R$ {{ number_format($recurso->sum('valor'), 2, ',', '.') }}</td>
                        </tr>
                    @endif
                </table>

                <br>

            @php $orgaoAuxiliar = $orgao; @endphp

        @endforeach
    @endif

    @if(count($cidade->apoiador) > 0)
        <table class="table">
            <tr class="text-center bg-gray font-bold">
                <td colspan="4" class="p-5">
                    Apoiadores
                </td>
            </tr>
            <tr class="text-center font-bold">
                <td width="25%">Nome</td>
                <td width="25%">Endereço</td>
                <td width="30%">Email</td>
                <td width="20%">Telefone</td>
            </tr>
            @foreach($cidade->apoiador as $apoiador)
                <tr class="text-center">
                    <td>{{ $apoiador->nome }}</td>
                    <td>{{ $apoiador->endereco }}</td>
                    <td>{{ $apoiador->email }}</td>
                    <td>{{ $apoiador->telefone }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <br>

    @if(count($cidade->visitas) > 0)
        <table class="table">
            <tr class="text-center bg-gray font-bold">
                <td colspan="3" class="p-5">
                    Visitas
                </td>
            </tr>
            <tr class="text-center font-bold">
                <td>Título</td>
                <td>Descrição</td>
                <td width="20%">Data</td>
            </tr>
            @foreach($cidade->visitas as $visita)
                <tr class="text-center">
                    <td>{{ $visita->titulo }}</td>
                    <td>{{ $visita->descricao }}</td>
                    <td width="20%">{{ date( 'd/m/Y' , strtotime($visita->data)) }}</td>
                </tr>
            @endforeach
        </table>
    @endif

</body>
</html>