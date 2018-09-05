@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administrar-visita.edit', $visita) }}
@endsection

@section('content')

    @if(Session::has('mensagem'))
        <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white text-center">
                    Editar Visita
                </div>
                <div class="card-body">
                    <div class="card-title text-right small font-italic font-weight-bold">
                        Campos com ( * ) são obrigatórios
                    </div>
                    {!! Form::open(['route' => ['administrar-visita.update', $visita->id]]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('cidade', 'Cidade', ['class' => 'control-label']) !!}
                                <select name="cidade_id" class="form-control {{ $errors->first('cidade_id') ? 'is-invalid' : ''}}" id="cidade">
                                    <option value="">Selecione</option>
                                    @foreach($cidades as $cidade)
                                        <option value="{{ $cidade->id }}" {{ ($visita->cidade->id == $cidade->id) ? 'selected' : '' }}>{{ $cidade->nome }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('cidade_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('data', 'Data', ['class' => 'control-label']) !!}
                                {!! Form::date('data', $visita->data, ['class' => ($errors->first('data')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => '01/01/2018']) !!}
                                <div class="invalid-feedback">{{ $errors->first('data') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('titulo', 'Título', ['class' => 'control-label']) !!}
                                {!! Form::text('titulo', $visita->titulo, ['class' => ($errors->first('titulo')) ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Ex.: Título da Visita']) !!}
                                <div class="invalid-feedback">{{ $errors->first('titulo') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <b class="text-danger">*</b>
                                {!! Form::label('descricao', 'Descrição', ['class' => 'control-label']) !!}
                                {!! Form::textarea('descricao', $visita->descricao, ['class' => ($errors->first('descricao')) ? 'form-control is-invalid' : 'form-control', 'rows' => 4]) !!}
                                <div class="invalid-feedback">{{ $errors->first('descricao') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                            <a href="{{ route('administrar-visita.editFoto', $visita->id) }}" class="btn btn-sm btn-primary btn-block">Alterar fotos</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center text-md-right text-lg-right">
                            <a href="{{ route('administrar-visita.index') }}" class="btn btn-outline-secondary">Voltar</a>
                            {!! Form::submit('Alterar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection