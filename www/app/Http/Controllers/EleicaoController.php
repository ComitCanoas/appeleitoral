<?php

namespace App\Http\Controllers;

use App\Repositories\CidadeRepository;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class EleicaoController extends Controller
{
    /**
     * @var CidadeRepository
     */
    private $cidadeRepository;

    public function __construct(CidadeRepository $cidadeRepository)
    {
        $this->cidadeRepository = $cidadeRepository;
    }

    public function index($id)
    {
        $cidades = $this->cidadeRepository->all();
        $cidade = $this->cidadeRepository->find($id);
		
        return view('eleicoes.index', compact('cidade', 'cidades'));
    }

    public function pdf($id)
    {
        $cidade = $this->cidadeRepository->find($id);
        $pdf = PDF::loadView('eleicoes.pdf', compact('cidade'));

        return $pdf->download($cidade->nome.'.pdf');
    }
}
