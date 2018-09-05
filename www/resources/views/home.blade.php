@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white text-center">Cidades</div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="cidade_saida">Saída</label>
                                    <select class="form-control" id="cidade_saida">
                                        <option>Selecione</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="cidade_destino">Destino</label>
                                    <select class="form-control" id="cidade_destino">
                                        <option>Selecione</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 col-sm-12 offset-md-5 offset-lg-5 col-md-2 col-lg-2">
                                <input type="button" value="Buscar" onclick="CalculaDistancia()" class="btn btn-primary btn-block" />
                            </div>
                        </div>
                        <div class="row mt-3" id="mostra_resultado_carregamento" style="display: none;">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="alert text-center" id="resultado_carregamento"></div>
                            </div>
                        </div>
                        <br>
                        <div id="resultado_cidades" style="display: none;">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="card mb-3 esconder_cidade_saida">
                                        <div class="card-header">
                                            <a href="#" id="resposta_cidade_saida"></a>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>População:</strong> <span id="cidade_saida_populacao"></span></li>
                                            <li class="list-group-item"><strong>Nº Eleitoires:</strong> <span id="cidade_saida_eleitores"></span></li>
                                        </ul>
                                    </div>

                                    <hr class="esconder_cidade_destino esconder_cidade_saida">

                                    <div class="card esconder_cidade_destino esconder_cidade_saida">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>Distância: </strong><span id="resposta_distancia"></span></li>
                                            <li class="list-group-item"><strong>Duração: </strong><span id="resposta_tempo"></span></li>
                                        </ul>
                                    </div>

                                    <hr class="esconder_cidade_destino esconder_cidade_saida">

                                    <div class="card mb-3 esconder_cidade_destino">
                                        <div class="card-header">
                                            <a href="#" id="resposta_cidade_destino"></a>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>População:</strong> <span id="cidade_destino_populacao"></span></li>
                                            <li class="list-group-item"><strong>Nº Eleitoires:</strong> <span id="cidade_destino_eleitores"></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-9 col-lg-9 mb-3">
                                    <iframe style="min-height: 400px" width="100%" scrolling="no" height="100%" frameborder="0" id="map" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?key=AIzaSyAUYQ2SVSeO93ffaGQ2gEcwjozEYPaSOgk&saddr=S&atilde;o Paulo&daddr=Rio de Janeiro&output=embed"></iframe>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
