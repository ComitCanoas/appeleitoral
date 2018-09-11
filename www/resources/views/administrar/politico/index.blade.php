@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('politico.index') }}
@endsection

@section('content')

    @if(Session::has('mensagem'))
        <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
    @endif

    <div class="row mb-3">
        <div class="col-12 col-sm-12 offset-md-10 offset-lg-10 col-md-2 col-lg-2">
            <a href="{{ route('politico.create') }}" class="btn btn-primary text-white btn-block">Cadastrar</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-secondary text-white text-center">
            Filtro
        </div>
        <div class="card-body">
            <div class="card-title text-right small font-italic font-weight-bold">
                Campos com ( * ) são obrigatórios
            </div>
            {!! Form::open(['route' => 'politico.index']) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <b class="text-danger">*</b>
                            {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
                            {!! Form::text('nome', app('request')->input('nome'), ['class' => ($errors->first('nome')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: João da Silva']) !!}
                            <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        {!! Form::submit('Pesquisar', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <br>

    @if(count($politicos) > 0 )
        <div class="card">
            <div class="card-header bg-secondary text-white text-center">
                Políticos
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($politicos as $politico)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                            <div class="card" style="height: 100%;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-center mb-3">
                                            <img src="
                                                    @if($politico->foto)
                                                        {{ asset('storage/politico/'.$politico->foto) }}
                                                    @elseif($politico->link_foto)
                                                        {{ $politico->link_foto }}
                                                    @else
                                                        {{ asset('/imagens/imagem.jpg') }}
                                                    @endif
                                                    " style="min-height: 150px; max-height: 150px; max-width: 150px; max-width: 150px;" class="img-thumbnail">
                                            <br><a href="{{ route('politico.editFoto', $politico->id) }}" class="btn btn-sm btn-primary mt-2">Alterar Foto</a>
                                        </div>
                                        <div class="col-12 text-center">
                                            {{ $politico->nome }}
                                        </div>
										@if ($politico->getPoliticoEleicao() != NULL)
											<div class="col-12 text-center">
	                                            <p class="small">{{ $politico->getPoliticoEleicao()->partido }}</p>
	                                        </div>
										@endif
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('politico.edit', $politico->id) }}" class="btn btn-sm btn-primary btn-block">Editar</a>

                                    <button type="button" class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#modal_{{ $politico->id }}" title="Excluíndo um político você irá excluir todas as informações das eleições referentes a ele">
                                        Excluir
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal_{{ $politico->id }}" tabindex="-1" role="dialog" aria-labelledby="Modal_{{ $politico->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-secondary text-white">
                                        <h5 class="modal-title" id="modal_{{ $politico->id }}">Apoiador</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        Deseja excluir {{ $politico->nome }}?<br><br>
                                        <small>*Você irá excluir todas as informações das eleições referentes a ele!</small>

                                        <br><br>
                                        <img src="
                                        @if($politico->foto)
                                        {{ asset('storage/politico/'.$politico->foto) }}
                                        @elseif($politico->link_foto)
                                        {{ $politico->link_foto }}
                                        @else
                                        {{ asset('/imagens/imagem.jpg') }}
                                        @endif
                                                " style="max-height: 150px; max-width: 120px;" class="img-thumbnail">
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('politico.destroy', ['id' => $politico->id]) }}" class="btn btn-danger">Excluir</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
            @if($politicos->hasPages())
                <div class="card-footer pb-0">
                    {{ $politicos->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="alert alert-info text-center">
            Não existem políticos cadastrados para sua pesquisa
        </div>
    @endif
@endsection
