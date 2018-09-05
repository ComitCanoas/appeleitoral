@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administrar-presidente-coordenador.editFoto', $presidenteCoordenador) }}
@endsection

@section('content')

    @if(Session::has('mensagem'))
        <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger text-center">{!! Session::get('error') !!}</div>
    @endif

    {!! Form::open(['route' => ['administrar-presidente-coordenador.updateFoto', $presidenteCoordenador->id ], 'enctype' => 'multipart/form-data']) !!}
    <div class="card">
        <div class="card-header bg-secondary text-center text-white">
            Editar Foto de {{ $presidenteCoordenador->nome }}
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12 col-sm-12 offset-md-4 col-md-4 offset-lg-4 col-lg-4 text-center">
                    <img class="img-fluid img-thumbnail" src="
                        @if($presidenteCoordenador->foto)
                            {{ asset('storage/presidente-coordenador/'.$presidenteCoordenador->foto) }}
                        @elseif($presidenteCoordenador->link_foto)
                            {{ $presidenteCoordenador->link_foto }}
                        @else
                            {{ asset('/imagens/imagem.jpg') }}
                        @endif
                            ">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-sm-12 offset-md-4 col-md-4 offset-lg-4 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('foto', 'Escolha a nova foto de ' . $presidenteCoordenador->nome, ['class' => 'control-label']) !!}
                        <input name="foto" type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : ''}}" id="foto">
                        <div class="invalid-feedback">{{ $errors->first('foto') }}</div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-12 col-sm-12 offset-md-4 col-md-4 offset-lg-4 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('link_foto', 'Ou link da foto', ['class' => 'control-label']) !!}
                        {!! Form::text('link_foto', null, ['class' => ($errors->first('link_foto')) ? 'form-control is-invalid' : 'form-control']) !!}
                        <div class="invalid-feedback">{{ $errors->first('link_foto') }}</div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12 col-sm-12 offset-md-4 col-md-4 offset-lg-4 col-lg-4 text-center">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('administrar-presidente-coordenador.edit', $presidenteCoordenador->id) }}" class="btn btn-outline-secondary btn-block">Voltar</a>
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