<?php

namespace App\Http\Controllers;

use App\Entities\PresidenteCoordenador;
use App\Http\Requests\PresidenteCoordenadorAdministrarEditRequest;
use App\Http\Requests\PresidenteCoordenadorAdministrarRequest;
use App\Http\Requests\PresidenteCoordenadorRequest;
use App\Http\Requests\UpdateFotoRequest;
use App\Repositories\CidadeRepository;
use App\Repositories\PresidenteCoordenadorRepository;
use App\Repositories\TipoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PresidenteCoordenadorController extends Controller
{
    /**
     * @var PresidenteCoordenadorRepository
     */
    private $presidenteCoordenadorRepository;

    /**
     * @var CidadeRepository
     */
    private $cidadeRepository;

    /**
     * @var TipoRepository
     */
    private $tipoRepository;

    public function __construct(
        PresidenteCoordenadorRepository $presidenteCoordenadorRepository,
        CidadeRepository $cidadeRepository,
        TipoRepository $tipoRepository)
    {
        $this->presidenteCoordenadorRepository = $presidenteCoordenadorRepository;
        $this->cidadeRepository = $cidadeRepository;
        $this->tipoRepository = $tipoRepository;
    }

    public function index()
    {
        return view('presidente-coordenador.index');
    }

    public function administrarIndex()
    {
        $cidades = $this->cidadeRepository->all();
        $presidentesCoordenadores = collect([]);

        return view('administrar.presidente-coordenador.index', compact('cidades', 'presidentesCoordenadores'));
    }

    public function create()
    {
        $cidades = $this->cidadeRepository->all();
        $tipos = $this->tipoRepository->all();

        return view('administrar.presidente-coordenador.create', compact('cidades', 'tipos'));
    }

    public function store(PresidenteCoordenadorAdministrarRequest $request)
    {
        $dados = $request->all();
        $foto = $request->file('foto');

        if($foto){
            $nome = Carbon::now()->format('dmYHis') . uniqid();
            $extensao = $request->foto->extension();
            $nomeArquivo = "{$nome}.{$extensao}";

            $dados['foto'] = $nomeArquivo;

            $presidenteCadastrado = $this->presidenteCoordenadorRepository->create($dados);

            $upload = $foto->storeAs('presidente-coordenador', $nomeArquivo);

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload de imagem');
            }

            $dados['link_foto'] = "";
        }else{
            $dados['foto'] = "";
            $presidenteCadastrado = $this->presidenteCoordenadorRepository->create($dados);
        }

        $mensagem = $presidenteCadastrado->nome . " cadastrado(a) com sucesso como " . $presidenteCadastrado->tipo->nome
            . ' da cidade de ' . $presidenteCadastrado->cidade->nome . ".";

        Session::flash('mensagem', $mensagem);

        return redirect()->route('administrar-presidente-coordenador.create');
    }

    public function edit($id)
    {
        $cidades = $this->cidadeRepository->all();
        $tipos = $this->tipoRepository->all();
        $presidenteCoordenador = $this->presidenteCoordenadorRepository->find($id);

        return view('administrar.presidente-coordenador.edit', compact('cidades', 'tipos', 'presidenteCoordenador'));
    }

    public function editFoto($id)
    {
        $presidenteCoordenador = $this->presidenteCoordenadorRepository->find($id);

        return view('administrar.presidente-coordenador.edit-foto', compact('presidenteCoordenador'));
    }

    public function destroy($id)
    {
        $presidenteCoordenador = $this->presidenteCoordenadorRepository->find($id);
        $mensagem = $presidenteCoordenador->nome . ' excluído(a) com sucesso da cidade de ' . $presidenteCoordenador->cidade->nome;

        $this->presidenteCoordenadorRepository->delete($id);

        if($presidenteCoordenador->foto) {
            Storage::delete('presidente-coordenador/' . $presidenteCoordenador->foto);
        }
        
        Session::flash('mensagem', $mensagem);

        return redirect()->route('administrar-presidente-coordenador.index');
    }

    public function update(PresidenteCoordenadorAdministrarEditRequest $request, $id)
    {
        $this->presidenteCoordenadorRepository->update($request->all(), $id);
        Session::flash('mensagem', 'Dados alterados com sucesso');

        return redirect()->route('administrar-presidente-coordenador.edit', $id);
    }

    public function updateFoto(UpdateFotoRequest $request, $id)
    {
        if($request->file('foto') && $request->get('link_foto')){
            Session::flash('error', 'Escolha somente um campo para foto');
            return redirect()->back();
        }

        $dados = $request->all();
        $foto = $request->file('foto');

        $presidenteCoordenador = $this->presidenteCoordenadorRepository->find($id);

        if($presidenteCoordenador->foto){
            Storage::delete('presidente-coordenador/'.$presidenteCoordenador->foto);
        }

        if($foto){
            $nome = Carbon::now()->format('dmYHis') . uniqid();
            $extensao = $request->foto->extension();
            $nomeArquivo = "{$nome}.{$extensao}";
            $dados['foto'] = $nomeArquivo;

            $upload = $foto->storeAs('presidente-coordenador', $nomeArquivo);

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload de imagem');
            }

            $dados['link_foto'] = "";
        }else{
            $dados['foto'] = "";
        }

        $this->presidenteCoordenadorRepository->update($dados, $id);

        Session::flash('mensagem', 'Foto alterada com sucesso');

        return redirect()->route('administrar-presidente-coordenador.editFoto', $id);
    }

    public function getPresidenteCoordenadorCidadeIndexCadastro(PresidenteCoordenadorRequest $request)
    {
        $cidades = $this->cidadeRepository->all();
        $cidadePesquisada = "";

        $presidentesCoordenadores = $this->presidenteCoordenadorRepository->findByField('cidade_id', $request->get('cidade'));
        $presidentesCoordenadores = $presidentesCoordenadores->sortBy('nome');

        return view('administrar.presidente-coordenador.index', compact('presidentesCoordenadores','cidades', 'cidadePesquisada'));
    }


    public function getPresidentesCoordenadoresCidadeJson($cidade)
    {
        $presidentesCoordenadores = $this->presidenteCoordenadorRepository->findByField('cidade_id', $cidade);
        $presidentesCoordenadores = $presidentesCoordenadores->sortBy('tipo_id');

        return Response::json($presidentesCoordenadores);
    }
}
