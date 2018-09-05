<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImagensRequest;
use App\Http\Requests\VisitaAdministrarEditRequest;
use App\Http\Requests\VisitaRequest;
use App\Repositories\CidadeRepository;
use App\Repositories\VisitaImagemRepository;
use App\Repositories\VisitaRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VisitaController extends Controller
{
    /**
     * @var CidadeRepository
     */
    private $cidadeRepository;

    /**
     * @var VisitaRepository
     */
    private $visitaRepository;

    /**
     * @var VisitaImagemRepository
     */
    private $visitaImagemRepository;

    public function __construct(CidadeRepository $cidadeRepository, VisitaRepository $visitaRepository, VisitaImagemRepository $visitaImagemRepository)
    {
        $this->cidadeRepository = $cidadeRepository;
        $this->visitaRepository = $visitaRepository;
        $this->visitaImagemRepository = $visitaImagemRepository;
    }

    public function index()
    {
        $cidades = $this->cidadeRepository->all();
        $visitas = collect([]);
        return view('visita.index', compact('cidades', 'visitas'));
    }

    public function administrarIndex()
    {
        $cidades = $this->cidadeRepository->all();
        $visitas = collect([]);

        return view('administrar.visita.index', compact('cidades', 'visitas'));
    }

    public function getVisitasCidade(Request $request)
    {
        $cidades = $this->cidadeRepository->all();

        $visitas = $this->visitaRepository->findByField('cidade_id', $request->get('cidade'));
        $visitas = $visitas->sortBy('created_at');

        return view('visita.index', compact('visitas','cidades'));
    }

    public function getVisitasCidadeIndexCadastro(Request $request)
    {
        $cidades = $this->cidadeRepository->all();

        $visitas = $this->visitaRepository->findByField('cidade_id', $request->get('cidade'));
        $visitas = $visitas->sortBy('created_at');

        return view('administrar.visita.index', compact('visitas','cidades'));
    }

    public function create()
    {
        $cidades = $this->cidadeRepository->all();
        return view('administrar.visita.create', compact('cidades'));
    }

    public function edit($id)
    {
        $cidades = $this->cidadeRepository->all();
        $visita = $this->visitaRepository->find($id);

        return view('administrar.visita.edit', compact('cidades', 'visita'));
    }

    public function editFoto($id)
    {
        $visita = $this->visitaRepository->find($id);

        return view('administrar.visita.edit-foto', compact('visita'));
    }

    public function update(VisitaAdministrarEditRequest $request, $id)
    {
        $this->visitaRepository->update($request->all(), $id);
        Session::flash('mensagem', 'Dados alterados com sucesso');

        return redirect()->route('administrar-visita.edit', $id);
    }

    public function addImagens(ImagensRequest $request, $id)
    {
        foreach ($request->imagens as $imagem){

            $nome = Carbon::now()->format('dmYHis') . uniqid();
            $extensao = $imagem->extension();
            $nomeArquivo = "{$nome}.{$extensao}";

            $upload = $imagem->storeAs('visitas', $nomeArquivo);

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload de imagem');
            }

            $this->visitaImagemRepository->create(['visita_id' => $id, 'nomeExtensao' => $nomeArquivo]);
        }

        Session::flash('mensagem', 'Imagens cadastradas com sucesso');

        return redirect()->route('administrar-visita.editFoto', $id);
    }

    public function store(VisitaRequest $request)
    {
        $data = $request->all();
        $imagens = $request->imagens;
        $visita = $this->visitaRepository->create($data);

        foreach ($imagens as $imagem)
        {
            $nome = Carbon::now()->format('dmYHis') . uniqid();
            $extensao = $imagem->extension();
            $nomeArquivo = "{$nome}.{$extensao}";

            $this->visitaImagemRepository->create(['visita_id' => $visita->id, 'nomeExtensao' => $nomeArquivo]);

            $upload = $imagem->storeAs('visitas', $nomeArquivo);

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload de imagem');
            }else{
                Session::flash('mensagem', 'Visita cadastrada com sucesso');
            }
        }

        return redirect()->route('administrar-visita.create');
    }

    public function destroy($id)
    {
        $visita = $this->visitaRepository->find($id);

        $mensagem = $visita->titulo . ' excluído(a) com sucesso da cidade de ' . $visita->cidade->nome;

        foreach($visita->imagens as $imagem){
            Storage::delete('visitas/'.$imagem->nomeExtensao);
            $this->visitaImagemRepository->delete($imagem->id);
        }

        $this->visitaRepository->delete($id);

        Session::flash('mensagem', $mensagem);

        return redirect()->route('administrar-visita.index');
    }

    public function destroyImagem($id, $idImagem)
    {
        $imagem = $this->visitaImagemRepository->find($idImagem);
        $visita = $this->visitaRepository->find($id);

        if(count($visita->imagens) > 1){
            Storage::delete('visitas/'.$imagem->nomeExtensao);
            $this->visitaImagemRepository->delete($idImagem);
            Session::flash('mensagem', 'Foto excluída com sucesso');
        }else{
            Session::flash('mensagemErro', 'Você tem que ter no mínimo uma foto por visita');
        }

        return redirect()->route('administrar-visita.editFoto', $id);
    }
}
