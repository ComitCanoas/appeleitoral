@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administrar-visita.editFoto', $visita) }}
@endsection

@section('content')

    @if(Session::has('mensagem'))
        <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
    @endif

    @if(Session::has('mensagemErro'))
        <div class="alert alert-danger text-center">{!! Session::get('mensagemErro') !!}</div>
    @endif

    {!! Form::open(['route' => ['administrar-visita.addImagens', $visita->id ], 'enctype' => 'multipart/form-data']) !!}
    <div class="card">
        <div class="card-header bg-secondary text-center text-white">
            Editar Fotos de {{ $visita->titulo }}
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($visita->imagens as $imagem)
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="card" style="height: 100%;">
                            <div class="card-body text-center">
                                <img class="img-fluid img-thumbnail" style="min-height: 230px; max-height: 230px;" src="{{ (Storage::exists('/visitas/'.$imagem->nomeExtensao)) ? asset('storage/visitas/'.$imagem->nomeExtensao) : asset('/imagens/imagem.jpg') }}">
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#modal_{{ $imagem->id }}">
                                    Excluir
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal_{{ $imagem->id }}" tabindex="-1" role="dialog" aria-labelledby="Modal_{{ $imagem->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-secondary text-white">
                                    <h5 class="modal-title" id="modal_{{ $imagem->id }}">Imagem da visita</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    Tem certeza que deseja excluir essa foto?
                                    <br><br>
                                    <img class="img-fluid img-thumbnail" style="min-height: 230px; max-height: 230px;" src="{{ (Storage::exists('/visitas/'.$imagem->nomeExtensao)) ? asset('storage/visitas/'.$imagem->nomeExtensao) : asset('/imagens/imagem.jpg') }}">
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                    <a href="{{ route('administrar-visita.destroyImagem', ['id' => $visita->id, 'idImagem' => $imagem->id]) }}" class="btn btn-danger">Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <br>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('imagens', 'Adicionar imagens', ['class' => 'control-label']) !!}
                        <input name="imagens[]" multiple="true" type="file" class="form-control-file {{ ($errors->first('imagens')) ? 'is-invalid' : '' }}" id="imagens">
                        <div class="invalid-feedback">{{ $errors->first('imagens') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12 col-sm-12 offset-md-4 col-md-4 offset-lg-4 col-lg-4 text-center">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('administrar-visita.edit', $visita->id) }}" class="btn btn-outline-secondary btn-block">Voltar</a>
                        </div>
                        <div class="col-6">
                            {!! Form::submit('Alterar', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection