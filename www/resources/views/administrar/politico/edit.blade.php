@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('politico.edit', $politico) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            @if(Session::has('mensagem'))
                <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger text-center">{!! Session::get('error') !!}</div>
            @endif

            <div class="card">
                <div class="card-header bg-secondary text-center text-white">
                    Editar Político
                </div>
                <div class="card-body">
                    <div class="card-title text-right small font-italic font-weight-bold">
                        Campos com ( * ) são obrigatórios
                    </div>
                    {!! Form::open(['route' => ['politico.update', $politico->id]]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
                                {!! Form::text('nome', $politico->nome, ['class' => ($errors->first('nome')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: João da Silva']) !!}
                                <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('telefone', 'Telefone', ['class' => 'control-label']) !!}
                                {!! Form::text('telefone', $politico->telefone, ['class' => ($errors->first('telefone')) ? 'form-control is-invalid cell-phone' : 'form-control cell-phone', 'placeholder' => '(51) 99999-9999']) !!}
                                <div class="invalid-feedback">{{ $errors->first('telefone') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('data_nascimento', 'Data de Nascimento', ['class' => 'control-label']) !!}
                                {!! Form::date('data_nascimento', $politico->data_nascimento, ['class' => ($errors->first('data_nascimento')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => '01/01/2018']) !!}
                                <div class="invalid-feedback">{{ $errors->first('data_nascimento') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                                {!! Form::email('email', $politico->email, ['class' => ($errors->first('email')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'nome@exemplo.com']) !!}
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
                                {!! Form::text('endereco', $politico->endereco, ['class' => ($errors->first('endereco')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: Rua Dois, 150.']) !!}
                                <div class="invalid-feedback">{{ $errors->first('endereco') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('cep', 'Cep', ['class' => 'control-label']) !!}
                                {!! Form::text('cep', $politico->cep, ['class' => ($errors->first('cep')) ? 'form-control is-invalid cep' : 'form-control cep', 'placeholder' => '92 300-300']) !!}
                                <div class="invalid-feedback">{{ $errors->first('cep') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="form-group">
                                {!! Form::label('cpf', 'Cpf', ['class' => 'control-label']) !!}
                                {!! Form::text('cpf', $politico->cpf, ['class' => ($errors->first('cpf')) ? 'form-control is-invalid cpf' : 'form-control cpf', 'disabled' => 'disabled']) !!}
                                <div class="invalid-feedback">{{ $errors->first('cpf') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center text-md-right text-lg-right">
                            <a href="{{ route('politico.index') }}" class="btn btn-outline-secondary">Voltar</a>
                            {!! Form::submit('Alterar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection