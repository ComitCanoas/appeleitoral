@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('eleicoes', $cidade) }}
@endsection

@section('content')
    <input type="hidden" id="nome_cidade"  value="{{ $cidade->nome . " " . $cidade->estado->nome }} ">

    <script type="text/javascript">
        window.onload = calculaCidadeAoCarregarPagina(document.getElementById('nome_cidade').value);
    </script>

    <div class="jumbotron jumbotron-fluid pb-0">
        <div class="container text-center">
            <h1 class="display-4 font-weight-bold p-0">{{ $cidade->nome }}</h1>
            <p>Gentílico: {{ $cidade->gentilico }}</p>
                <p class="lead">Cidade de {{ $cidade->nome }} tem uma população de <strong>{{ number_format($cidade->populacao,-3,',','.') }}</strong> pessoas com <strong>{{ number_format($cidade->numero_eleitores,-3,',','.') }}</strong> eleitores.</p>
            <div class="row">
                <div class="col-12">
                    <iframe style="min-height: 400px" width="100%" scrolling="no" height="100%" frameborder="0" id="map" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?key=AIzaSyAUYQ2SVSeO93ffaGQ2gEcwjozEYPaSOgk&saddr=S&atilde;o Paulo&daddr=Rio de Janeiro&output=embed"></iframe>
                </div>
            </div>

            @if($cidade->cidadePolitico)
                <br>

                <div class="row">
                    @if($cidade->cidadePolitico->prefeito)
                        @php
                            $prefeito = $cidade->cidadePolitico->prefeito;
                        @endphp

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-2 mb-2">
                            <div class="card" style="height: 100%;">
                                <div class="card-header font-weight-bold">
                                    Prefeito
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-center mb-3">
                                            <img src="
                                                @if($prefeito->foto)
                                                    {{ asset('storage/politico/'.$prefeito->foto) }}
                                                @elseif($prefeito->link_foto)
                                                    {{ $prefeito->link_foto }}
                                                @else
                                                    {{ asset('/imagens/imagem.jpg') }}
                                                @endif
                                                " style="min-height: 150px; max-height: 150px; max-width: 150px; max-width: 150px;" class="img-thumbnail">
                                        </div>
                                        <div class="col-12 text-center">
                                            <h3 class="card-title font-weight-bold text-center">
                                                {{ $prefeito->nome }}
												@if($prefeito->getPoliticoEleicao() != NULL)
													<p style="font-size: 14px;">{{ $prefeito->getPoliticoEleicao()->partido }}</p>
											    @endif
                                            </h3>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    Endereço: {{ $prefeito->endereco }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    E-mail: {{ $prefeito->email }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    Telefone: {{ $prefeito->telefone }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($cidade->cidadePolitico->vicePrefeito)
                        @php
                            $vicePrefeito = $cidade->cidadePolitico->vicePrefeito;
                        @endphp

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-2 mb-2">
                            <div class="card" style="height: 100%;">
                                <div class="card-header font-weight-bold">
                                    Vice-prefeito
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-center mb-3">
                                            <img src="
                                                @if($vicePrefeito->foto)
                                                    {{ asset('storage/politico/'.$vicePrefeito->foto) }}
                                                @elseif($vicePrefeito->link_foto)
                                                    {{ $vicePrefeito->link_foto }}
                                                @else
                                                    {{ asset('/imagens/imagem.jpg') }}
                                                @endif
                                            " style="min-height: 150px; max-height: 150px; max-width: 150px; max-width: 150px;" class="img-thumbnail">
                                        </div>
                                        <div class="col-12 text-center">
                                            <h3 class="card-title font-weight-bold text-center">
                                                {{ $vicePrefeito->nome }}
												@if($vicePrefeito->getPoliticoEleicao() != NULL)
													<p style="font-size: 14px;">{{ $vicePrefeito->getPoliticoEleicao()->partido }}</p>
											    @endif
                                            </h3>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    Endereço: {{ $vicePrefeito->endereco }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    E-mail: {{ $vicePrefeito->email }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    Telefone: {{ $vicePrefeito->telefone }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($cidade->cidadePolitico->candidatoPTB)
                        @php
                            $candidatoPTB = $cidade->cidadePolitico->candidatoPTB;
                        @endphp

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-2 mb-2">
                            <div class="card" style="height: 100%;">
                                <div class="card-header text-danger font-weight-bold">
                                    Candidato PTB
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-center mb-3">
                                            <img src="
                                                @if($candidatoPTB->foto)
                                                    {{ asset('storage/politico/'.$candidatoPTB->foto) }}
                                                @elseif($candidatoPTB->link_foto)
                                                    {{ $candidatoPTB->link_foto }}
                                                @else
                                                    {{ asset('/imagens/imagem.jpg') }}
                                                @endif
                                            " style="min-height: 150px; max-height: 150px; max-width: 150px; max-width: 150px;" class="img-thumbnail">
                                        </div>
                                        <div class="col-12 text-center">
                                            <h3 class="card-title font-weight-bold text-center">
                                                {{ $candidatoPTB->nome }}
												@if($candidatoPTB->getPoliticoEleicao() != NULL)
													<p style="font-size: 14px;">{{ $candidatoPTB->getPoliticoEleicao()->partido }}</p>
											    @endif
                                            </h3>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    Endereço: {{ $candidatoPTB->endereco }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    E-mail: {{ $candidatoPTB->email }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    Telefone: {{ $candidatoPTB->telefone }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <div class="row">
                <div class="col-12 col-sm-12 offset-md-2 offset-lg-3 col-md-4 col-lg-3 mt-3 mb-3">
                    <a href="{{ route('home') }}" class="btn btn-primary btn-block">NOVA PESQUISA</a>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-3 mt-3 mb-3">
                    <a href="{{ route('eleicoes.pdf', $cidade->id) }}" class="btn btn-primary btn-block">DOWNLOAD</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs pull-right"  id="myTab" role="tablist">

                @foreach($cidade->eleicao as $key => $eleicao)
                    <li class="nav-item">
                        <a class="nav-link {{ ($key == 0) ? 'active' : '' }}" id="eleicao{{ $eleicao->id }}-tab" data-toggle="tab" href="#eleicao{{ $eleicao->id }}" role="tab" aria-controls="eleicao{{ $eleicao->id }}" aria-selected="false">Eleição {{ $eleicao->ano_eleicao }}</a>
                    </li>
                @endforeach

                <li class="nav-item">
                    <a class="nav-link {{ (count($cidade->eleicao) == 0) ? 'active' : '' }}" id="coordenador-tab" data-toggle="tab" href="#coordenador" role="tab" aria-controls="coordenador" aria-selected="true">Liderança ({{ count($cidade->presidenteCoordenador) }})</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="recurso-tab" data-toggle="tab" href="#recurso" role="tab" aria-controls="recurso" aria-selected="false">Recursos ({{ count($cidade->recurso) }})</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="apoiador-tab" data-toggle="tab" href="#apoiador" role="tab" aria-controls="apoiador" aria-selected="false">Apoiadores ({{ count($cidade->apoiador) }})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="visitas-tab" data-toggle="tab" href="#visitas" role="tab" aria-controls="visitas" aria-selected="false">Visitas ({{ count($cidade->visitas) }})</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                @foreach($cidade->eleicao as $key => $eleicao)
                    <div class="tab-pane fade {{ ($key == 0) ? 'show active' : '' }}" id="eleicao{{ $eleicao->id }}" role="tabpanel" aria-labelledby="eleicao{{ $eleicao->id }}-tab">
                        <div class="accordion" id="accordionExample">

                            @if(count($eleicao->politicoEleicao) > 0)

                                @php
                                    $cargos = $eleicao->politicoEleicao->groupBy('cargo_id');

                                    $agrupadosPorCargo = $cargos->keyBy(function ($value, $key) {
                                        $cargo = \App\Entities\Cargo::find($key);
                                        return $cargo->nome;
                                    })->sortKeys();
                                @endphp

                                @foreach($agrupadosPorCargo as $cargo => $politicos)

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 bg-secondary font-weight-bold text-white text-center p-2">
                                                {{ $cargo }}
                                            </div>
                                        </div>
                                        <div class="row text-muted font-weight-bold" style="background: #E0EEEE;">
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-center border-danger p-2">
                                                Nome
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center p-2">
                                                Partido
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center p-2">
                                                Quantidade de Votos
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center p-2">
                                                Status
                                            </div>
                                        </div>
                                    </div>

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
                                        $deputadosFederaisEscolhidos = $ordenaPorVotos->whereIn('politico_id', [156839,156467,156564]);
                                        $deputadosEstaduaisEscolhidos = $ordenaPorVotos->whereIn('politico_id', [156392,156594,156179,156218,156649]);

                                        //atribuo o tipo de deputado
                                        $deputadosEscolhidos = ($cargo == \App\Entities\Cargo::DEPUTADO_FEDERAL)
                                                        ? $deputadosFederaisEscolhidos
                                                        : ($cargo == \App\Entities\Cargo::DEPUTADO_ESTADUAL)
                                                        ? $deputadosEstaduaisEscolhidos
                                                        : collect([]);

                                        foreach ($deputadosEscolhidos as $deputado){
                                            $osCincoDeputadosMaisVotados->push($deputado);
                                        }

                                        $ptb = (($cargo == \App\Entities\Cargo::DEPUTADO_FEDERAL) || ($cargo == \App\Entities\Cargo::DEPUTADO_ESTADUAL))
                                                ? $osCincoDeputadosMaisVotados
                                                : $vereadoresEleitos;

                                    @endphp

                                    @foreach($ptb as $politicoEleicao)
                                        <div class="card {{ (in_array($politicoEleicao->politico->id, [156839,156467,156564,156392,156594,156179,156218,156649])) ? "font-weight-bold" : "" }}">
                                            <div class="card-header" id="heading{{ $politicoEleicao->politico->id }}">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-center border-danger p-2">
                                                        {{ $politicoEleicao->politico->nome }}
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center p-2">
                                                        {{ $politicoEleicao->partido }}
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center p-2">
                                                        {{ number_format($politicoEleicao->quantidade_votos,-3,',','.') }}
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center p-2">
                                                        @if($politicoEleicao->eleito == 'S')
                                                            <strong class="text-success">Eleito</strong>
                                                        @else
                                                            <strong class="text-danger">Não eleito</strong>
                                                        @endif
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center mt-2 mt-md-2 mt-lg-2" style="background: #F7F7F7;">
                                                        <button class="btn btn-sm btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapse{{ $politicoEleicao->politico->id }}" aria-expanded="false" aria-controls="collapse{{ $politicoEleicao->politico->id }}">
                                                            Ver mais
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse{{ $politicoEleicao->politico->id }}" class="collapse" aria-labelledby="heading{{ $politicoEleicao->politico->id }}" data-parent="#accordion{{ $politicoEleicao->politico->id }}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 text-center">
                                                            <img src="
                                                                @if($politicoEleicao->politico->foto)
                                                                    {{ asset('storage/politico/'.$politicoEleicao->politico->foto) }}
                                                                @elseif($politicoEleicao->politico->link_foto)
                                                                    {{ $politicoEleicao->politico->link_foto }}
                                                                @else
                                                                    {{ asset('/imagens/imagem.jpg') }}
                                                                @endif
                                                                    " style="max-height: 150px; max-width: 120px;" class="img-thumbnail">
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 text-center text-md-left text-lg-left">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <strong>Nascimento:</strong> {{ $politicoEleicao->politico->data_nascimento }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <strong>Endereço:</strong> {{ $politicoEleicao->politico->endereco }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <strong>Cep:</strong> {{ $politicoEleicao->politico->cep }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <strong>E-mail:</strong> {{ $politicoEleicao->politico->email }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <strong>Telefone:</strong> {{ $politicoEleicao->politico->telefone }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @else
                                <div class="alert alert-info text-center">
                                    Não há informações cadastradadas dessa eleição para cidade de {{ $cidade->nome }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <div class="tab-pane fade {{ (count($cidade->eleicao) == 0) ? 'show active' : '' }}" id="coordenador" role="tabpanel" aria-labelledby="coordenador-tab">
                    @if(count($cidade->presidenteCoordenador) > 0)
                        @foreach($cidade->presidenteCoordenador as $presidenteCoordenador)
                            <div class="card">
                                <div class="card-header bg-secondary text-center text-white font-weight-bold">
                                    {{ $presidenteCoordenador->tipo->nome }}
                                </div>
                                <div class="card-body text-primary">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 text-center">
                                            <img src="
                                                @if($presidenteCoordenador->foto)
                                                    {{ asset('storage/presidente-coordenador/'.$presidenteCoordenador->foto) }}
                                                @elseif($presidenteCoordenador->link_foto)
                                                    {{ $presidenteCoordenador->link_foto }}
                                                @else
                                                    {{ asset('/imagens/imagem.jpg') }}
                                                @endif
                                            " style="max-height: 150px; max-width: 120px;" class="img-thumbnail">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 text-center text-md-left text-lg-left">
                                            <h3 class="card-title font-weight-bold">
                                                {{ $presidenteCoordenador->nome }}
                                            </h3>
                                            <div class="row">
                                                <div class="col-12 col-md-8 col-lg-8">
                                                    Endereço: {{ $presidenteCoordenador->endereco }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-8 col-lg-8">
                                                    E-mail: {{ $presidenteCoordenador->email }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-8 col-lg-8">
                                                    Telefone: {{ $presidenteCoordenador->telefone }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    @else
                        <div class="alert alert-info text-center">
                            Não há coordenadores cadastradados para esta cidade
                        </div>
                    @endif
                </div>

                <div class="tab-pane fade" id="recurso" role="tabpanel" aria-labelledby="recurso-tab">
                    @if(count($cidade->recurso) > 0)

                        @php
                            $orgaoAuxiliar = "";

                            $recursosOrgaos = $cidade->recurso->groupBy('orgao_id');

                            $recursos = $recursosOrgaos->keyBy(function ($value, $key) {
                                $orgao = \App\Entities\Orgao::find($key);
                                return $orgao->nome;
                            })->sortKeys();

                        @endphp

                        @foreach($recursos as $orgao => $recurso)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    @if($orgaoAuxiliar != $orgao)
                                        <thead>
                                        <tr class="text-center bg-info text-white">
                                            <th colspan="5" class="border-info">{{ $orgao }}</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>Ano</th>
                                            <th>Processo</th>
                                            <th>Ação</th>
                                            <th>Emenda</th>
                                            <th>Valor</th>
                                        </tr>
                                        </thead>
                                    @endif

                                    <tbody>
                                    @foreach($recurso as $key => $value)
                                        <tr class="text-center">
                                            <td style="width: 10%;">{{ $value['ano'] }}</td>
                                            <td style="width: 20%;">{{ $value['processo'] }}</td>
                                            <td style="width: 32%;">{{ $value['acao'] }}</td>
                                            <td style="width: 20%;">{{ $value['situacao'] }}</td>
                                            <td style="width: 12%;">R$ {{ number_format($value['valor'], 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                    @if($orgaoAuxiliar != $orgao)
                                        <tfoot>
                                        <tr style="background: #CCC;">
                                            <td colspan="4" class="text-right font-weight-bold">Total:</td>
                                            <td class="text-center font-weight-bold">R$ {{ number_format($recurso->sum('valor'), 2, ',', '.') }}</td>
                                        </tr>
                                        </tfoot>
                                    @endif
                                </table>
                            </div>

                            @php $orgaoAuxiliar = $orgao; @endphp

                            <br>

                        @endforeach
                    @else
                        <div class="alert alert-info text-center">
                            Não há recursos cadastradados para esta cidade
                        </div>
                    @endif
                </div>

                <div class="tab-pane fade" id="apoiador" role="tabpanel" aria-labelledby="apoiador-tab">
                    @if(count($cidade->apoiador) > 0)
                        <div class="row">
                            @foreach($cidade->apoiador as $apoiador)
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3">
                                    <div class="card" style="height: 100%;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 text-center mb-3">
                                                    <img src="
                                                        @if($apoiador->foto)
                                                            {{ asset('storage/apoiador/'.$apoiador->foto) }}
                                                        @elseif($apoiador->link_foto)
                                                            {{ $apoiador->link_foto }}
                                                        @else
                                                            {{ asset('/imagens/imagem.jpg') }}
                                                        @endif
                                                    " style="min-height: 150px; max-height: 150px; max-width: 150px; max-width: 150px;" class="img-thumbnail">
                                                </div>
                                                <div class="col-12 text-center">
                                                    <h3 class="card-title font-weight-bold text-center">
                                                        {{ $apoiador->nome }}
                                                    </h3>
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            Endereço: {{ $apoiador->endereco }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            E-mail: {{ $apoiador->email }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            Telefone: {{ $apoiador->telefone }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            Não há apoiadores cadastradados para esta cidade
                        </div>
                    @endif
                </div>

                <div class="tab-pane fade" id="visitas" role="tabpanel" aria-labelledby="visitas-tab">
                    @if(count($cidade->visitas) > 0)
                        <div class="row">
                            @foreach($cidade->visitas as $visita)
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="card mb-3">
                                        <div id="carouselExampleControls{{ $visita->id }}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($visita->imagens as $key => $imagem)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="max-height: 350px; min-height: 350px">
                                                        <img class="d-block w-100 img-fluid" style="max-height: 350px; min-height: 350px" src="{{ asset('storage/visitas/'.$imagem->nomeExtensao) }}" alt="First slide">
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if($visita->imagens->count() > 1)
                                                <a class="carousel-control-prev" href="#carouselExampleControls{{ $visita->id }}" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Anterior</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleControls{{ $visita->id }}" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Próximo</span>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $visita->titulo }}</h5>
                                            <p class="card-text">{{ $visita->descricao }}</p>
                                            <p class="card-text"><small class="text-muted">Fotos da visita em <strong>{{ date( 'd/m/Y' , strtotime($visita->data)) }}</strong>.</small></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            Não há visitas cadastradadas para esta cidade
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
