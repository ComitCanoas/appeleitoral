<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Políticos
Breadcrumbs::for('politico', function ($trail) {
    $trail->parent('home');
    $trail->push('Politicos', route('politico.index'));
});

//Home > Administrar Politico > [Cadastro]
Breadcrumbs::for('politico.create', function ($trail) {
    $trail->parent('politico.index');
    $trail->push('Cadastro', route('politico.create'));
});

//Home > Administrar Político > [Editar]
Breadcrumbs::for('politico.edit', function ($trail, $politico) {
    $trail->parent('politico.index');
    $trail->push('Editar', route('politico.edit', $politico->id));
});

// Home > Eleições
Breadcrumbs::for('eleicoes', function ($trail, $cidade) {
    $trail->parent('home');
    $trail->push('Eleições', route('eleicoes.index', $cidade->id));
});

// Home > Recursos
Breadcrumbs::for('recurso', function ($trail) {
    $trail->parent('home');
    $trail->push('Recursos', route('recurso.index'));
});

// Home > Apoiador
Breadcrumbs::for('apoiador', function ($trail) {
    $trail->parent('home');
    $trail->push('Apoiadores', route('apoiador.index'));
});

//Home > Administrar Apoiador > [Index]
Breadcrumbs::for('administrar-apoiador.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Administrar Apoiador', route('administrar-apoiador.index'));
});

//Home > Administrar Apoiador > [Cadastro]
Breadcrumbs::for('administrar-apoiador.create', function ($trail) {
    $trail->parent('administrar-apoiador.index');
    $trail->push('Cadastro', route('administrar-apoiador.create'));
});

//Home > Administrar Apoiador > [Editar]
Breadcrumbs::for('administrar-apoiador.edit', function ($trail, $apoiador) {
    $trail->parent('administrar-apoiador.index');
    $trail->push('Editar', route('administrar-apoiador.edit', $apoiador->id));
});

//Home > Administrar Apoiador > Editar > [Foto]
Breadcrumbs::for('administrar-apoiador.editFoto', function ($trail, $apoiador) {
    $trail->parent('administrar-apoiador.edit', $apoiador);
    $trail->push('Foto', route('administrar-apoiador.editFoto', $apoiador->id));
});

// Home > Presidente Coordenador
Breadcrumbs::for('presidente-coordenador', function ($trail) {
    $trail->parent('home');
    $trail->push('Presidente Coordenador', route('presidente-coordenador.index'));
});

// Home > Presidente Coordenador > [Cadastro]
Breadcrumbs::for('presidente-coordenador.create', function ($trail) {
    $trail->parent('presidente-coordenador');
    $trail->push('Cadastro', route('presidente-coordenador.create'));
});

// Home > Visita
Breadcrumbs::for('visita', function ($trail) {
    $trail->parent('home');
    $trail->push('Visitas', route('visita.index'));
});

// Home > Administrar Visita > [Index]
Breadcrumbs::for('administrar-visita.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Administrar Visita', route('administrar-visita.index'));
});

// Home > Administrar Visita > [Cadastro]
Breadcrumbs::for('administrar-visita.create', function ($trail) {
    $trail->parent('administrar-visita.index');
    $trail->push('Cadastro', route('administrar-visita.create'));
});

//Home > Administrar Visita > [Editar]
Breadcrumbs::for('administrar-visita.edit', function ($trail, $visita) {
    $trail->parent('administrar-visita.index');
    $trail->push('Editar', route('administrar-visita.edit', $visita->id));
});

//Home > Administrar Visita > Editar > [Foto]
Breadcrumbs::for('administrar-visita.editFoto', function ($trail, $visita) {
    $trail->parent('administrar-visita.edit', $visita);
    $trail->push('Foto', route('administrar-visita.editFoto', $visita->id));
});

//Home > Presidente Coordenador > [Index]
Breadcrumbs::for('administrar-presidente-coordenador.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Administrar Presidente Coordenador', route('administrar-presidente-coordenador.index'));
});

//Home > Presidente Coordenador > [Cadastro]
Breadcrumbs::for('administrar-presidente-coordenador.create', function ($trail) {
    $trail->parent('administrar-presidente-coordenador.index');
    $trail->push('Cadastro', route('administrar-presidente-coordenador.create'));
});

//Home > Presidente Coordenador > [Editar]
Breadcrumbs::for('administrar-presidente-coordenador.edit', function ($trail, $presidenteCoordenador) {
    $trail->parent('administrar-presidente-coordenador.index');
    $trail->push('Editar', route('administrar-presidente-coordenador.edit', $presidenteCoordenador->id));
});

//Home > Presidente Coordenador > Editar > [Foto]
Breadcrumbs::for('administrar-presidente-coordenador.editFoto', function ($trail, $presidenteCoordenador) {
    $trail->parent('administrar-presidente-coordenador.edit', $presidenteCoordenador);
    $trail->push('Foto', route('administrar-presidente-coordenador.editFoto', $presidenteCoordenador->id));
});

//Home > Recursos > [Index]
Breadcrumbs::for('administrar-recurso.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Administrar Recursos', route('administrar-recurso.index'));
});

//Home > Recursos > [Cadastro]
Breadcrumbs::for('administrar-recurso.create', function ($trail) {
    $trail->parent('administrar-recurso.index');
    $trail->push('Cadastro', route('administrar-recurso.create'));
});

//Home > Recursos > [Editar]
Breadcrumbs::for('administrar-recurso.edit', function ($trail, $recurso) {
    $trail->parent('administrar-recurso.index');
    $trail->push('Editar', route('administrar-recurso.edit', $recurso->id));
});

//Home > Usuários > [Index]
Breadcrumbs::for('user.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Administrar Usuários', route('user.index'));
});

//Home > Usuários > [Cadastro]
Breadcrumbs::for('user.create', function ($trail) {
    $trail->parent('user.index');
    $trail->push('Cadastro', route('user.create'));
});

//Home > Recursos > [Editar]
Breadcrumbs::for('user.edit', function ($trail, $user) {
    $trail->parent('user.index');
    $trail->push('Editar', route('user.edit', $user->id));
});

//Home > Usuários > [Index]
Breadcrumbs::for('politico.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Administrar Político', route('politico.index'));
});

//Home > Usuários > Editar > [Foto]
Breadcrumbs::for('politico.editFoto', function ($trail, $politico) {
    $trail->parent('politico.index');
    $trail->push('Editar Foto', route('politico.editFoto', $politico->id));
});