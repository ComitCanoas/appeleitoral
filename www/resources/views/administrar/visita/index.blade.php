@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administrar-visita.index') }}
@endsection

@section('content')

    @if(Session::has('mensagem'))
        <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
    @endif

    <div class="row mb-3">
        <div class="col-12 col-sm-12 offset-md-10 offset-lg-10 col-md-2 col-lg-2">
            <a href="{{ route('administrar-visita.create') }}" class="btn btn-primary text-white btn-block">Cadastrar</a>
        </div>
    </div>

    {!! Form::open(['route' => 'visita.getVisitasCidadeIndexCadastro']) !!}
    <div class="card">
        <div class="card-header bg-secondary text-white text-center">
            Pesquisar Visitas Cadastradas
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="cidade_visita">Cidade</label>
                <select name="cidade" class="form-control" id="cidade_visita">
                    <option>Selecione</option>
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade->id }}" @if(request()->get('cidade') == $cidade->id) {{ 'selected' }} @endif>{{ $cidade->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 offset-md-5 offset-lg-5 col-md-2 col-lg-2">
                    <input type="submit" value="Buscar" class="btn btn-primary btn-block" />
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <br>

    @if(request()->isMethod('post'))
        @if(count($visitas) > 0)
            @foreach($visitas as $visita)

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                <div id="carouselExampleControls{{ $visita->id }}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($visita->imagens as $key => $imagem)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="max-height: 200px; min-height: 200px">
                                                <img class="d-block w-100 img-fluid" style="max-height: 200px; min-height: 200px" src="{{ asset('storage/visitas/'.$imagem->nomeExtensao) }}" alt="First slide">
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
                            </div>
                            <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                                <h3 class="mt-3">{{ $visita->titulo }}</h3>
                                <p>{{ $visita->descricao }}</p>
                                <p class="card-text"><small class="text-muted">Visita do dia <strong>{{ date( 'd/m/Y' , strtotime($visita->data)) }}</strong>.</small></p>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('administrar-visita.edit', $visita->id) }}" class="btn btn-secondary text-white">Editar</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_{{ $visita->id }}">
                            Excluir
                        </button>
                    </div>
                </div>

                <div class="modal fade" id="modal_{{ $visita->id }}" tabindex="-1" role="dialog" aria-labelledby="Modal_{{ $visita->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-secondary text-white">
                                <h5 class="modal-title" id="modal_{{ $visita->id }}">Visita</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                Deseja excluir {{ $visita->titulo }}?
                                <br>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                <a href="{{ route('administrar-visita.destroy', ['id' => $visita->id]) }}" class="btn btn-danger">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
            @endforeach

        @else
            <div class="alert alert-info text-center">
                Não existem visitas cadastradas para essa cidade
            </div>
        @endif
    @endif



@endsection