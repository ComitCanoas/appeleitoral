<?php

namespace App\Http\Controllers;

use App\Repositories\CidadeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * @var $cidadeRepository;
     */
    private $cidadeRepository;

    public function __construct(CidadeRepository $cidadeRepository)
    {
        $this->middleware('auth');
        $this->cidadeRepository = $cidadeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidades = $this->cidadeRepository->all();
        return view('home', compact('cidades'));
    }

    public function getCidadeSaida($cidade_saida)
    {
        $cidade = $this->cidadeRepository->find($cidade_saida);
        $cidade->estado_id = $cidade->estado;
        return Response::json($cidade);
    }

    public function getCidadeDestino($cidade_destino)
    {
        $cidade = $this->cidadeRepository->find($cidade_destino);
        $cidade->estado_id = $cidade->estado;

        return Response::json($cidade);
    }
}
