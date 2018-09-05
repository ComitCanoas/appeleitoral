@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administrar-recurso.index') }}
@endsection

@section('content')

    @if(Session::has('mensagem'))
        <div class="alert alert-danger text-center">{!! Session::get('mensagem') !!}</div>
    @endif

    <div class="row mb-3">
        <div class="col-12 col-sm-12 offset-md-10 offset-lg-10 col-md-2 col-lg-2">
            <a href="{{ route('administrar-recurso.create') }}" class="btn btn-primary text-white btn-block">Cadastrar</a>
        </div>
    </div>

    {!! Form::open(['route' => 'administrar-recurso.searchRecursos']) !!}
    <div class="card">
        <div class="card-header bg-secondary text-white text-center">
            Pesquisar Recursos
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="cidade_recurso">Cidade</label>
                        <select name="cidade_recurso" class="form-control {{ ($errors->first('cidade_recurso')) ? 'is-invalid' : '' }}" id="cidade_recurso">
                            <option value="">Selecione</option>
                            @foreach($cidades as $cidade)
                                <option value="{{ $cidade->id }}" @if (request()->get('cidade_recurso') == $cidade->id) {{ 'selected' }} @endif>{{ $cidade->nome }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('cidade_recurso') }}</div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="orgao_recurso">Orgão</label>
                        <select name="orgao_recurso" class="form-control" id="orgao_recurso">
                            <option value="">Selecione</option>
                            @foreach($orgaos as $orgao)
                                <option value="{{ $orgao->id }}" @if(request()->get('orgao_recurso') == $orgao->id) {{ 'selected' }} @endif>{{ $orgao->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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
        @if(count($recursos) > 0)

            @php $orgaoAuxiliar = ""; @endphp

            @foreach($recursos as $orgao => $recurso)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        @if($orgaoAuxiliar != $orgao)
                            <thead>
                            <tr class="text-center bg-info text-white">
                                <th colspan="7" class="border-info">{{ $orgao }}</th>
                            </tr>
                            <tr class="text-center">
                                <th>Ano</th>
                                <th>Processo</th>
                                <th>Ação</th>
                                <th>Instituição</th>
                                <th>Situação</th>
                                <th>Valor</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                        @endif

                        <tbody>
                        @foreach($recurso as $key => $value)
                            <tr class="text-center">
                                <td style="width: 5%;">{{ $value['ano'] }}</td>
                                <td style="width: 8%;">{{ $value['processo'] }}</td>
                                <td style="width: 25%;">{{ $value['acao'] }}</td>
                                <td style="width: 25%;">{{ $value['instituicao'] }}</td>
                                <td style="width: 12%;">{{ $value['situacao'] }}</td>
                                <td style="width: 10%;">R$ {{ number_format($value['valor'], 2, ',', '.') }}</td>
                                <td style="width: 15%;">
                                    <a href="{{ route('administrar-recurso.edit', $value['id']) }}" class="btn btn-sm btn-secondary">Editar</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_{{ $value['id'] }}">
                                        Excluir
                                    </button>

                                    <div class="modal fade" id="modal_{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="Modal_{{ $value['id'] }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-secondary text-white">
                                                    <h5 class="modal-title" id="modal_{{ $value['id'] }}">Recurso</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Deseja excluir o recurso <strong>{{ $value['acao'] }}</strong> da instituição <strong>{{ $value['instituicao'] }}</strong>?
                                                    <br>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                                    <a href="{{ route('administrar-recurso.destroy', ['id' => $value['id']]) }}" class="btn btn-danger">Excluir</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                        @if($orgaoAuxiliar != $orgao)
                            <tfoot>
                            <tr style="background: #CCC;">
                                <td colspan="5" class="text-right font-weight-bold">Total:</td>
                                <td class="text-center font-weight-bold">R$ {{ number_format($recurso->sum('valor'), 2, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>

                @php $orgaoAuxiliar = $orgao; @endphp

                <br>
            @endforeach
        @else
            <div class="alert alert-info text-center">
                Não existem recursos cadastrados
            </div>
        @endif
    @endif
@endsection