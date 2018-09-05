<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\PresidenteCoordenadorRepository::class, \App\Repositories\PresidenteCoordenadorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CidadeRepository::class, \App\Repositories\CidadeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TipoRepository::class, \App\Repositories\TipoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PoliticoRepository::class, \App\Repositories\PoliticoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ApoiadorRepository::class, \App\Repositories\ApoiadorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrgaoRepository::class, \App\Repositories\OrgaoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RecursoRepository::class, \App\Repositories\RecursoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\VisitaRepository::class, \App\Repositories\VisitaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\VisitaImagemRepository::class, \App\Repositories\VisitaImagemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EleicaoRepository::class, \App\Repositories\EleicaoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PoliticoEleicaoRepository::class, \App\Repositories\PoliticoEleicaoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoleRepository::class, \App\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRoleRepository::class, \App\Repositories\UserRoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
