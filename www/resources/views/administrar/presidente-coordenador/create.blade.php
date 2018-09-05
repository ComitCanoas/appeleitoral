@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administrar-presidente-coordenador.create') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            @if(Session::has('mensagem'))
                <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
            @endif

            <div class="card">
                <div class="card-header bg-secondary text-center text-white">
                    Cadastrar Presidente Coordenador
                </div>
                <div class="card-body">
                    <div class="card-title text-right small font-italic font-weight-bold">
                        Campos com ( * ) são obrigatórios
                    </div>
                    {!! Form::open(['route' => 'administrar-presidente-coordenador.store', 'enctype' => 'multipart/form-data']) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('cidade', 'Cidade', ['class' => 'control-label']) !!}
                                <select name="cidade_id" class="form-control {{ $errors->first('cidade_id') ? 'is-invalid' : ''}}" id="cidade">
                                    <option value="">Selecione</option>
                                    @foreach($cidades as $cidade)
                                        <option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
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
                                        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
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
                                {!! Form::text('nome', null, ['class' => ($errors->first('nome')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: João da Silva']) !!}
                                <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('telefone', 'Telefone', ['class' => 'control-label']) !!}
                                {!! Form::text('telefone', null, ['class' => ($errors->first('telefone')) ? 'form-control cell-phone is-invalid' : 'form-control cell-phone', 'placeholder' => '(51)99999-9999']) !!}
                                <div class="invalid-feedback">{{ $errors->first('telefone') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                                {!! Form::email('email', null, ['class' => ($errors->first('email')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'nome@exemplo.com']) !!}
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
                                {!! Form::text('endereco', null, ['class' => ($errors->first('endereco')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: Rua Dois, 150.']) !!}
                                <div class="invalid-feedback">{{ $errors->first('endereco') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                {!! Form::label('foto', 'Foto', ['class' => 'control-label']) !!}
                                <input name="foto" type="file" class="form-control-file {{ ($errors->first('foto')) ? 'is-invalid' : '' }}" id="foto">
                                <div class="invalid-feedback">{{ $errors->first('foto') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                {!! Form::label('link_foto', 'Ou link da foto', ['class' => 'control-label']) !!}
                                {!! Form::text('link_foto', null, ['class' => ($errors->first('link_foto')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'http://site.com.br/foto.jpg']) !!}
                                <div class="invalid-feedback">{{ $errors->first('link_foto') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center text-md-right text-lg-right">
                            <a href="{{ route('administrar-presidente-coordenador.index') }}" class="btn btn-outline-secondary">Voltar</a>
                            {!! Form::submit('Cadastrar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection