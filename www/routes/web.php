<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['middleware' =>'guest', function(){
    return view('auth.login');
}]);

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
$this->get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('admin/password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('cidade/saida/{id}', 'HomeController@getCidadeSaida');
    Route::get('cidade/destino/{id}', 'HomeController@getCidadeDestino');
    Route::get('cidade/presidente-coordenador/{id}', 'HomeController@getPresidenteCoordenadorPelaCidade');

    Route::get('presidente-coordenador/cidade/{id}', 'PresidenteCoordenadorController@getPresidentesCoordenadoresCidadeJson')
                            ->name('presidente-coordenador.getPresidentesCoordenadoresCidadeJson');

    Route::get('eleicoes/{id}/cidade', 'EleicaoController@index')->name('eleicoes.index');
    Route::get('eleicoes/{id}/cidade/pdf', 'EleicaoController@pdf')->name('eleicoes.pdf');

    Route::group(['prefix' => 'administrar', 'middleware' => ['cadastro']], function(){

        Route::group(['prefix' => 'politico'], function() {
            Route::get('', 'PoliticoController@index')->name('politico.index');
            Route::post('', 'PoliticoController@index')->name('politico.index');
            Route::get('{id}/editar/foto', 'PoliticoController@editFoto')->name('politico.editFoto');
            Route::post('{id}/editar/foto', 'PoliticoController@updateFoto')->name('politico.updateFoto');
            Route::get('{id}/excluir', 'PoliticoController@destroy')->name('politico.destroy');
            Route::get('cadastrar', 'PoliticoController@create')->name('politico.create');
            Route::post('cadastrar', 'PoliticoController@store')->name('politico.store');
            Route::get('{id}/editar', 'PoliticoController@edit')->name('politico.edit');
            Route::post('{id}/editar', 'PoliticoController@update')->name('politico.update');
        });

        Route::group(['prefix' => 'usuarios', 'middleware' => ['admin']], function(){
           Route::get('', 'UserController@index')->name('user.index');
           Route::get('cadastrar', 'Auth\RegisterController@showRegistrationForm')->name('user.create');
           Route::post('cadastrar', 'Auth\RegisterController@register')->name('user.store');
           Route::get('{id}/editar', 'UserController@edit')->name('user.edit');
           Route::post('{id}/editar', 'Auth\RegisterController@update')->name('user.update');
           Route::get('{id}/excluir', 'Auth\RegisterController@destroy')->name('user.destroy');
           Route::get('{id}/ativar', 'Auth\RegisterController@restore')->name('user.restore');
        });

        Route::group(['prefix' => 'recurso'], function(){
           Route::get('', 'RecursoController@administrarIndex')->name('administrar-recurso.index');
           Route::post('', 'RecursoController@searchRecursos')->name('administrar-recurso.searchRecursos');
           Route::get('cadastrar', 'RecursoController@create')->name('administrar-recurso.create');
           Route::post('cadastrar', 'RecursoController@store')->name('administrar-recurso.store');
           Route::get('{id}/editar', 'RecursoController@edit')->name('administrar-recurso.edit');
           Route::post('{id}/editar', 'RecursoController@update')->name('administrar-recurso.update');
           Route::get('{id}/excluir', 'RecursoController@destroy')->name('administrar-recurso.destroy');
        });

        Route::group(['prefix' => 'apoiador'], function(){
            Route::get('', 'ApoiadorController@administrarIndex')->name('administrar-apoiador.index');
            Route::post('', 'ApoiadorController@getApoiadorCidadeIndexCadastro')->name('administrar-apoiador.getApoiadorCidadeIndexCadastro');
            Route::get('cadastrar', 'ApoiadorController@create')->name('administrar-apoiador.create');
            Route::post('cadastrar', 'ApoiadorController@store')->name('administrar-apoiador.store');
            Route::get('{id}/excluir', 'ApoiadorController@destroy')->name('administrar-apoiador.destroy');
            Route::get('{id}/editar', 'ApoiadorController@edit')->name('administrar-apoiador.edit');
            Route::post('{id}/editar', 'ApoiadorController@update')->name('administrar-apoiador.update');
            Route::get('{id}/editar/foto', 'ApoiadorController@editFoto')->name('administrar-apoiador.editFoto');
            Route::post('{id}/editar/foto', 'ApoiadorController@updateFoto')->name('administrar-apoiador.updateFoto');
        });

        Route::group(['prefix' => 'presidente-coordenador'], function(){
            Route::get('', 'PresidenteCoordenadorController@administrarIndex')->name('administrar-presidente-coordenador.index');
            Route::post('', 'PresidenteCoordenadorController@getPresidenteCoordenadorCidadeIndexCadastro')->name('administrar-presidente-coordenador.getPresidenteCoordenadorCidadeIndexCadastro');
            Route::get('cadastrar', 'PresidenteCoordenadorController@create')->name('administrar-presidente-coordenador.create');
            Route::post('cadastrar', 'PresidenteCoordenadorController@store')->name('administrar-presidente-coordenador.store');
            Route::get('{id}/excluir', 'PresidenteCoordenadorController@destroy')->name('administrar-presidente-coordenador.destroy');
            Route::get('{id}/editar', 'PresidenteCoordenadorController@edit')->name('administrar-presidente-coordenador.edit');
            Route::post('{id}/editar', 'PresidenteCoordenadorController@update')->name('administrar-presidente-coordenador.update');
            Route::get('{id}/editar/foto', 'PresidenteCoordenadorController@editFoto')->name('administrar-presidente-coordenador.editFoto');
            Route::post('{id}/editar/foto', 'PresidenteCoordenadorController@updateFoto')->name('administrar-presidente-coordenador.updateFoto');

        });

        Route::group(['prefix' => 'visita'], function(){
            Route::get('', 'VisitaController@administrarIndex')->name('administrar-visita.index');
            Route::get('cadastrar', 'VisitaController@create')->name('administrar-visita.create');
            Route::post('cadastrar', 'VisitaController@store')->name('administrar-visita.store');
            Route::post('visitas', 'VisitaController@getVisitasCidadeIndexCadastro')->name('visita.getVisitasCidadeIndexCadastro');
            Route::get('{id}/editar', 'VisitaController@edit')->name('administrar-visita.edit');
            Route::post('{id}/editar', 'VisitaController@update')->name('administrar-visita.update');
            Route::get('{id}/excluir', 'VisitaController@destroy')->name('administrar-visita.destroy');
            Route::get('{id}/editar/imagem', 'VisitaController@editFoto')->name('administrar-visita.editFoto');
            Route::post('{id}/editar/imagem', 'VisitaController@addImagens')->name('administrar-visita.addImagens');
            Route::get('{id}/excluir/{idImagem}/imagem', 'VisitaController@destroyImagem')->name('administrar-visita.destroyImagem');
        });
    });
});