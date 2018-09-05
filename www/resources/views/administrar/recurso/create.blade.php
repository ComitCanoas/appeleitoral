@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administrar-recurso.create') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            @if(Session::has('mensagem'))
                <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
            @endif

            <div class="card">
                <div class="card-header bg-secondary text-center text-white">
                    Cadastrar Recurso
                </div>
                <div class="card-body">
                    <div class="card-title text-right small font-italic font-weight-bold">
                        Campos com ( * ) são obrigatórios
                    </div>
                    {!! Form::open(['route' => 'administrar-recurso.store']) !!}
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
                                {!! Form::label('orgao', 'Orgão', ['class' => 'control-label']) !!}
                                <select name="orgao_id" class="form-control {{ $errors->first('orgao_id') ? 'is-invalid' : ''}}" id="orgao">
                                    <option value="">Selecione</option>
                                    @foreach($orgaos as $orgao)
                                        <option value="{{ $orgao->id }}">{{ $orgao->nome }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('orgao_id') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('acao', 'Ação', ['class' => 'control-label']) !!}
                                {!! Form::text('acao', null, ['class' => ($errors->first('acao')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: Reforma na sala de aula']) !!}
                                <div class="invalid-feedback">{{ $errors->first('acao') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('instituicao', 'Instituição', ['class' => 'control-label']) !!}
                                {!! Form::text('instituicao', null, ['class' => ($errors->first('instituicao')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: Escola da reforma']) !!}
                                <div class="invalid-feedback">{{ $errors->first('instituicao') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('ano', 'Ano', ['class' => 'control-label']) !!}
                                {!! Form::text('ano', null, ['class' => ($errors->first('ano')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: 2018']) !!}
                                <div class="invalid-feedback">{{ $errors->first('ano') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('processo', 'Processo', ['class' => 'control-label']) !!}
                                {!! Form::text('processo', null, ['class' => ($errors->first('processo')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: 00000000']) !!}
                                <div class="invalid-feedback">{{ $errors->first('processo') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('situacao', 'Situação', ['class' => 'control-label']) !!}
                                {!! Form::text('situacao', null, ['class' => ($errors->first('situacao')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: Aprovado']) !!}
                                <div class="invalid-feedback">{{ $errors->first('situacao') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('valor', 'Valor', ['class' => 'control-label']) !!}
                                {!! Form::text('valor', null, ['class' => ($errors->first('valor')) ? 'form-control real is-invalid' : 'form-control real', 'placeholder' => 'Ex.: 500,00']) !!}
                                <div class="invalid-feedback">{{ $errors->first('valor') }}</div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-12 text-center text-md-right text-lg-right">
                            <a href="{{ route('administrar-recurso.index') }}" class="btn btn-outline-secondary">Voltar</a>
                            {!! Form::submit('Cadastrar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection