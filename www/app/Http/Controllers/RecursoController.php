<?php

namespace App\Http\Controllers;

use App\Entities\Orgao;
use App\Http\Requests\RecursoAdministrarRequest;
use App\Http\Requests\RecursoRequest;
use App\Repositories\CidadeRepository;
use App\Repositories\OrgaoRepository;
use App\Repositories\RecursoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RecursoController extends Controller
{
    /**
     * @var CidadeRepository
     */
    private $cidadeRepository;

    /**
     * @var OrgaoRepository
     */
    private $orgaoRepository;

    /**
     * @var RecursoRepository
     */
    private $recursoRepository;

    public function __construct(CidadeRepository $cidadeRepository, OrgaoRepository $orgaoRepository, RecursoRepository $recursoRepository)
    {
        $this->cidadeRepository = $cidadeRepository;
        $this->orgaoRepository = $orgaoRepository;
        $this->recursoRepository = $recursoRepository;
    }

    public function index()
    {
        $cidades = $this->cidadeRepository->all();
        $orgaos = $this->orgaoRepository->all();

        $recursos = collect([]);

        return view('recurso.index', compact('cidades', 'orgaos', 'recursos'));
    }

    public function administrarIndex()
    {
        $cidades = $this->cidadeRepository->all();
        $orgaos = $this->orgaoRepository->all();

        return view('administrar.recurso.index', compact('cidades', 'orgaos'));
    }

    public function create()
    {
        $cidades = $this->cidadeRepository->all();
        $orgaos = $this->orgaoRepository->all();

        return view('administrar.recurso.create', compact('cidades', 'orgaos'));
    }

    public function store(RecursoAdministrarRequest $request)
    {
        //formato o valor que vem do form (Ex.: 25.000,00) para o padrão do banco de dados. (Ex.: 25000.00) << deve ser salvo assim no banco
        $request['valor'] = str_replace(',', '.', str_replace(".","",$request->valor));

        $this->recursoRepository->create($request->all());

        Session::flash('mensagem', 'Recurso cadastrado com sucesso');

        return redirect()->route('administrar-recurso.create');
    }

    public function edit($id)
    {
        $cidades = $this->cidadeRepository->all();
        $orgaos = $this->orgaoRepository->all();
        $recurso = $this->recursoRepository->find($id);

        return view('administrar.recurso.edit', compact('cidades', 'orgaos', 'recurso'));
    }

    public function update(RecursoAdministrarRequest $request, $id)
    {
        //formato o valor que vem do form (Ex.: 25.000,00) para o padrão do banco de dados. (Ex.: 25000.00) << deve ser salvo assim no banco
        $request['valor'] = str_replace(',', '.', str_replace(".","",$request->valor));

        $this->recursoRepository->update($request->all(), $id);
        Session::flash('mensagem', 'Dados alterados com sucesso');

        return redirect()->route('administrar-recurso.edit', $id);
    }

    public function searchRecursos(RecursoRequest $request)
    {
        $cidades = $this->cidadeRepository->all();
        $orgaos = $this->orgaoRepository->all();

        if($request->filled('orgao_recurso')) {
            $recursosCidade = $this->recursoRepository->findWhere(['orgao_id' => $request->get('orgao_recurso'), 'cidade_id' => $request->get('cidade_recurso')]);
            $recursosOrgaos = $recursosCidade->groupBy('orgao_id');
        }else{
            $recursosCidade = $this->cidadeRepository->find($request->get('cidade_recurso'));
            $recursosOrgaos = $recursosCidade->recurso->groupBy('orgao_id');
        }

        $recursos = $recursosOrgaos->keyBy(function ($value, $key) {
            $orgao = $this->orgaoRepository->find($key);
            return $orgao->nome;
        })->sortKeys();

        return view('administrar.recurso.index', compact('cidades','recursos', 'orgaos'));
    }



    public function destroy($id)
    {
        $recurso = $this->recursoRepository->find($id);
        $mensagem = $recurso->acao . ' excluído com sucesso da cidade de ' . $recurso->cidade->nome;

        $this->recursoRepository->delete($id);

        Session::flash('mensagem', $mensagem);

        return redirect()->route('administrar-recurso.index');
    }
}
