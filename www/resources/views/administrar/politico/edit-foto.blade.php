@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('politico.editFoto', $politico) }}
@endsection

@section('content')

    @if(Session::has('mensagem'))
        <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger text-center">{!! Session::get('error') !!}</div>
    @endif

    {!! Form::open(['route' => ['politico.updateFoto', $politico->id ], 'enctype' => 'multipart/form-data']) !!}
    <div class="card">
        <div class="card-header bg-secondary text-center text-white">
            Editar Foto de {{ $politico->nome }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 offset-md-4 col-md-4 offset-lg-4 col-lg-4 text-center">
                    <img class="img-fluid img-thumbnail"
                         src="
                            @if($politico->foto)
                                 {{ asset('storage/politico/'.$politico->foto) }}
                            @elseif($politico->link_foto)
                                 {{ $politico->link_foto }}
                            @else
                                 {{ asset('/imagens/imagem.jpg') }}
                            @endif
                             "
                            >
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-sm-12 offset-md-4 col-md-4 offset-lg-4 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('foto', 'Escolha a nova foto de ' . $politico->nome, ['class' => 'control-label']) !!}
                        <input name="foto" type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : ''}}" id="foto">
                        <div class="invalid-feedback font-weight-bold">{{ $errors->first('foto') }}</div>
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
                            <a href="{{ route('politico.index') }}" class="btn btn-outline-secondary btn-block">Voltar</a>
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