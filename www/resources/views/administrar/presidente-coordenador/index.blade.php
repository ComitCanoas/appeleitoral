@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administrar-presidente-coordenador.index') }}
@endsection

@section('content')

    @if(Session::has('mensagem'))
        <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
    @endif

    <div class="row mb-3">
        <div class="col-12 col-sm-12 offset-md-10 offset-lg-10 col-md-2 col-lg-2">
            <a href="{{ route('administrar-presidente-coordenador.create') }}" class="btn btn-primary text-white btn-block">Cadastrar</a>
        </div>
    </div>

    {!! Form::open(['route' => 'administrar-presidente-coordenador.getPresidenteCoordenadorCidadeIndexCadastro']) !!}
    <div class="card">
        <div class="card-header bg-secondary text-white text-center">
            Pesquisar Presidentes Coordenadores Cadastrados
        </div>
        <div class="card-body">
            <div class="card-title text-right small font-italic font-weight-bold">
                Campos com ( * ) são obrigatórios
            </div>
            <div class="form-group">
                <b class="text-danger">*</b>
                <label for="cidade">Cidade</label>
                <select name="cidade" class="form-control {{ $errors->first('cidade') ? 'is-invalid' : ''}}" id="cidade">
                    <option value="">Selecione</option>
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade->id }}"  @if (request()->get('cidade') == $cidade->id) {{ 'selected' }} @endif>{{ $cidade->nome }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('cidade') }}</div>
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
        @if(count($presidentesCoordenadores) > 0)
            @foreach($presidentesCoordenadores as $presidenteCoordenador)

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center font-weight-bold text-muted" style="background: #CCC;">
                                {{ $presidenteCoordenador->tipo->nome }}
                            </div>
                            <div class="card-body">
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
                                         /   </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('administrar-presidente-coordenador.edit', $presidenteCoordenador->id) }}" class="btn btn-secondary">Editar</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_{{ $presidenteCoordenador->id }}">
                                    Excluir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal_{{ $presidenteCoordenador->id }}" tabindex="-1" role="dialog" aria-labelledby="Modal_{{ $presidenteCoordenador->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-secondary text-white">
                                <h5 class="modal-title" id="modal_{{ $presidenteCoordenador->id }}">Presidente Coordenador</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                Deseja excluir {{ $presidenteCoordenador->nome }}?
                                <br><br>
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
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                <a href="{{ route('administrar-presidente-coordenador.destroy', ['id' => $presidenteCoordenador->id]) }}" class="btn btn-danger">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
            @endforeach
        @else
            <div class="alert alert-info text-center">
                Não existem presidentes coordenadores cadastrados para essa cidade
            </div>
        @endif
    @endif
@endsection