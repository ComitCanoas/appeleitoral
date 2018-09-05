@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('user.index') }}
@endsection

@section('content')

    @if(Session::has('mensagem'))
        <div class="alert alert-success text-center">{!! Session::get('mensagem') !!}</div>
    @endif

    <div class="row mb-3">
        <div class="col-12 col-sm-12 offset-md-10 offset-lg-10 col-md-2 col-lg-2">
            <a href="{{ route('user.create') }}" class="btn btn-primary text-white btn-block">Cadastrar</a>
        </div>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr class="text-center bg-secondary text-white">
                <th colspan="4">Usuários</th>
            </tr>
            <tr class="text-center">
                <th>Nome</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="text-center @if($user->deleted_at) text-danger font-weight-bold @endif @if($user->id == Auth::user()->id) font-weight-bold bg-light @endif">
                    <td>{{ $user->name }} @if($user->id == Auth::user()->id) (Você) @endif</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->userRole)
                            {{ $user->userRole->role->nome }}
                        @endif
                    </td>
                    <td>
                        @if($user->id != Auth::user()->id)
                            @if($user->deleted_at)
                                <a href="{{ route('user.restore', $user->id) }}" class="btn btn-success btn-sm">Ativar</a>
                            @else
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-secondary btn-sm">Editar</a>

                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_{{ $user->id }}">
                                    Inativar
                                </button>

                                <div class="modal fade" id="modal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="Modal_{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary text-white">
                                                <h5 class="modal-title" id="modal_{{ $user->id }}">Usuário</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                Deseja inativar {{ $user->name }}?
                                                <br>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                                <a href="{{ route('user.destroy', ['id' => $user->id]) }}" class="btn btn-danger">Inativar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="text-center">
                <td colspan="4">
                    {{ $users->links() }}
                    <div>Total de {{ $users->total() }} usuários</div>
                </td>
            </tr>
        </tfoot>
    </table>





@endsection