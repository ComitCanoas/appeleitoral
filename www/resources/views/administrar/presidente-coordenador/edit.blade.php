@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administrar-presidente-coordenador.edit', $presidenteCoordenador) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            @if(Session::has('mensagem'))
                <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
            @endif

            {!! Form::open(['route' => ['administrar-presidente-coordenador.update', $presidenteCoordenador->id], 'enctype' => 'multipart/form-data']) !!}

            <div class="card">
                <div class="card-header bg-secondary text-center text-white">
                    Editar Presidente Coordenador
                </div>
                <div class="card-body">
                    <div class="card-title text-right small font-italic font-weight-bold">
                        Campos com ( * ) são obrigatórios
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group">
                            <img class="img-fluid img-thumbnail" src="
                                @if($presidenteCoordenador->foto)
                                    {{ asset('storage/presidente-coordenador/'.$presidenteCoordenador->foto) }}
                                @elseif($presidenteCoordenador->link_foto)
                                    {{ $presidenteCoordenador->link_foto }}
                                @else
                                    {{ asset('/imagens/imagem.jpg') }}
                                @endif
                                    ">
                            <a href="{{ route('administrar-presidente-coordenador.editFoto', $presidenteCoordenador->id) }}" class="btn btn-primary btn-block btn-sm mt-1">Alterar Foto</a>
                        </div>
                    </div>
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9">

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        {!! Form::label('cidade', 'Cidade', ['class' => 'control-label']) !!}
                                        <select name="cidade_id" class="form-control {{ $errors->first('cidade_id') ? 'is-invalid' : ''}}" id="cidade">
                                            <option value="">Selecione</option>
                                            @foreach($cidades as $cidade)
                                                <option value="{{ $cidade->id }}" {{ ($presidenteCoordenador->cidade->id == $cidade->id) ? 'selected' : '' }}>{{ $cidade->nome }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('cidade_id') }}</div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        {!! Form::label('tipo', 'Tipo', ['class' => 'control-label']) !!}
                                        <select name="tipo_id" class="form-control {{ $errors->first('tipo_id') ? 'is-invalid' : ''}}" id="tipo">
                                            <option value="">Selecione</option>
                                            @foreach($tipos as $tipo)
                                                <option value="{{ $tipo->id }}" {{ ($presidenteCoordenador->tipo->id == $tipo->id) ? 'selected' : '' }}>{{ $tipo->nome }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('tipo_id') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
                                        {!! Form::text('nome', $presidenteCoordenador->nome, ['class' => ($errors->first('nome')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: João da Silva']) !!}
                                        <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        {!! Form::label('telefone', 'Telefone', ['class' => 'control-label']) !!}
                                        {!! Form::text('telefone', $presidenteCoordenador->telefone, ['class' => ($errors->first('telefone')) ? 'form-control cell-phone is-invalid' : 'form-control cell-phone', 'placeholder' => '(51)99999-9999']) !!}
                                        <div class="invalid-feedback">{{ $errors->first('telefone') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                                        {!! Form::email('email', $presidenteCoordenador->email, ['class' => ($errors->first('email')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'nome@exemplo.com']) !!}
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
                                        {!! Form::text('endereco', $presidenteCoordenador->endereco, ['class' => ($errors->first('endereco')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: Rua Dois, 150.']) !!}
                                        <div class="invalid-feedback">{{ $errors->first('endereco') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-2 col-lg-2 offset-md-4 offset-lg-4">
                            <a href="{{ route('administrar-presidente-coordenador.index') }}" class="btn btn-outline-secondary btn-block">Voltar</a>
                        </div>
                        <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                            {!! Form::submit('Alterar', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection