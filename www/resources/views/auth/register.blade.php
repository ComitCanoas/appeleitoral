@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('user.create') }}
@endsection

@section('content')

    @if(Session::has('mensagem'))
        <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary text-white text-center">{{ __('Cadastrar Usuário') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6">
                                <div class="form-group">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
                                    {!! Form::text('name', null, ['class' => ($errors->first('name')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: João da Silva']) !!}
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6">
                                <div class="form-group">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                                    {!! Form::email('email', null, ['class' => ($errors->first('email')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'nome@exemplo.com']) !!}
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6">
                                <div class="form-group">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6">
                                <div class="form-group">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('password-confirm', 'Confirmar Senha', ['class' => 'control-label']) !!}
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6">
                                <div class="form-group">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('perfil', 'Perfil', ['class' => 'control-label']) !!}
                                    {!! Form::select('perfil', $perfis, null, ['class' => $errors->first('perfil') ? 'form-control is-invalid' : 'form-control']) !!}
                                    <div class="invalid-feedback font-weight-bold">{{ $errors->first('perfil') }}</div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="form-group row mb-0">
                            <div class="col-12 text-center">
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Voltar</a>
                                {!! Form::submit('Cadastrar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
