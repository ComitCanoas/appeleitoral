<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApoiadorAdministrarEditRequest;
use App\Http\Requests\ApoiadorAdministrarRequest;
use App\Http\Requests\ApoiadorRequest;
use App\Http\Requests\UpdateFotoRequest;
use App\Repositories\ApoiadorRepository;
use App\Repositories\CidadeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ApoiadorController extends Controller
{
    /**
     * @var CidadeRepository
     */
    private $cidadeRepository;
    /**
     * @var ApoiadorRepository
     */
    private $apoiadorRepository;

    public function __construct(CidadeRepository $cidadeRepository, ApoiadorRepository $apoiadorRepository)
    {
        $this->apoiadorRepository = $apoiadorRepository;
        $this->cidadeRepository = $cidadeRepository;
    }

    public function index()
    {
        $cidades = $this->cidadeRepository->all();
        $apoiadores = collect([]);
        return view('apoiador.index', compact('cidades', 'apoiadores'));
    }

    public function administrarIndex()
    {
        $cidades = $this->cidadeRepository->all();
        $apoiadores = collect([]);

        return view('administrar.apoiador.index', compact('cidades', 'apoiadores'));
    }

    public function create()
    {
        $cidades = $this->cidadeRepository->all();

        return view('administrar.apoiador.create', compact('cidades'));
    }

    public function store(ApoiadorAdministrarRequest $request)
    {
        $dados = $request->all();
        $foto = $request->file('foto');

        if($foto){
            $nome = Carbon::now()->format('dmYHis') . uniqid();
            $extensao = $request->foto->extension();
            $nomeArquivo = "{$nome}.{$extensao}";

            $dados['foto'] = $nomeArquivo;

            $apoiador = $this->apoiadorRepository->create($dados);

            $upload = $foto->storeAs('apoiador', $nomeArquivo);

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload de imagem');
            }

            $dados['link_foto'] = "";
        }else{
            $dados['foto'] = "";
            $apoiador = $this->apoiadorRepository->create($dados);
        }

        $mensagem = $apoiador->nome . " cadastrado(a) com sucesso como apoiador"
            . ' da cidade de ' . $apoiador->cidade->nome . ".";

        Session::flash('mensagem', $mensagem);

        return redirect()->route('administrar-apoiador.create');
    }

    public function edit($id)
    {
        $cidades = $this->cidadeRepository->all();
        $apoiador = $this->apoiadorRepository->find($id);

        return view('administrar.apoiador.edit', compact('cidades', 'apoiador'));
    }

    public function editFoto($id)
    {
        $apoiador = $this->apoiadorRepository->find($id);

        return view('administrar.apoiador.edit-foto', compact('apoiador'));
    }

    public function update(ApoiadorAdministrarEditRequest $request, $id)
    {
        $this->apoiadorRepository->update($request->all(), $id);
        Session::flash('mensagem', 'Dados alterados com sucesso');

        return redirect()->route('administrar-apoiador.edit', $id);
    }

    public function updateFoto(UpdateFotoRequest $request, $id)
    {
        if($request->file('foto') && $request->get('link_foto')){
            Session::flash('error', 'Escolha somente um campo para foto');
            return redirect()->back();
        }

        $dados = $request->all();
        $foto = $request->file('foto');

        $apoiador = $this->apoiadorRepository->find($id);

        if($apoiador->foto){
            Storage::delete('apoiador/'.$apoiador->foto);
        }

        if($foto){
            $nome = Carbon::now()->format('dmYHis') . uniqid();
            $extensao = $request->foto->extension();
            $nomeArquivo = "{$nome}.{$extensao}";
            $dados['foto'] = $nomeArquivo;

            $upload = $foto->storeAs('apoiador', $nomeArquivo);

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload de imagem');
            }

            $dados['link_foto'] = "";
        }else{
            $dados['foto'] = "";
        }

        $this->apoiadorRepository->update($dados, $id);

        Session::flash('mensagem', 'Foto alterada com sucesso');

        return redirect()->route('administrar-apoiador.editFoto', $id);
    }

    public function destroy($id)
    {
        $apoiador = $this->apoiadorRepository->find($id);
        $mensagem = $apoiador->nome . ' excluído(a) com sucesso da cidade de ' . $apoiador->cidade->nome;

        $this->apoiadorRepository->delete($id);

        if($apoiador->foto){
            Storage::delete('apoiador/'.$apoiador->foto);
        }

        Session::flash('mensagem', $mensagem);

        return redirect()->route('administrar-apoiador.index');
    }

    public function getApoiadoresCidade(Request $request)
    {
        $apoiadores = $this->apoiadorRepository->findByField('cidade_id', $request->get('cidade'));
        $cidades = $this->cidadeRepository->all();

        $apoiadores = $apoiadores->sortBy('created_at');

        return view('apoiador.index', compact('apoiadores','cidades'));
    }

    public function getApoiadorCidadeIndexCadastro(ApoiadorRequest $request)
    {
        $cidades = $this->cidadeRepository->all();
        $cidadePesquisada = "";

        $apoiadores = $this->apoiadorRepository->findByField('cidade_id', $request->get('cidade'));
        $apoiadores = $apoiadores->sortBy('nome');

        return view('administrar.apoiador.index', compact('apoiadores','cidades', 'cidadePesquisada'));
    }
}
