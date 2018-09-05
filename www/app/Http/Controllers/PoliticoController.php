<?php

namespace App\Http\Controllers;

use App\Entities\Politico;
use App\Http\Requests\CidadeRequest;
use App\Http\Requests\PoliticoEditRequest;
use App\Http\Requests\PoliticoRequest;
use App\Http\Requests\UpdateFotoRequest;
use App\Repositories\CidadeRepository;
use App\Repositories\PoliticoEleicaoRepository;
use App\Repositories\PoliticoRepository;
use App\Repositories\PresidenteCoordenadorRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PoliticoController extends Controller
{
    /**
     * @var CidadeRepository
     */
    private $cidadeRepository;

    /**
     * @var PoliticoRepository
     */
    private $politicoRepository;

    private $presidenteCoordenadorRepository;

    /**
     * @var PoliticoEleicaoRepository
     */
    private $politicoEleicaoRepository;

    public function __construct(CidadeRepository $cidadeRepository,
                                PoliticoRepository $politicoRepository,
                                PresidenteCoordenadorRepository $presidenteCoordenadorRepository,
                                PoliticoEleicaoRepository $politicoEleicaoRepository)
    {
        $this->cidadeRepository = $cidadeRepository;
        $this->politicoRepository = $politicoRepository;
        $this->presidenteCoordenadorRepository = $presidenteCoordenadorRepository;
        $this->politicoEleicaoRepository = $politicoEleicaoRepository;
    }

    public function index(Request $request)
    {
        if(request()->has('nome')){
            $politicos = Politico::where('nome', 'like', '%'.$request->get('nome').'%')->paginate(12)->appends('nome', request('nome'));
        }else{
            $politicos = $this->politicoRepository->orderBy('nome')->paginate(12);
        }

        return view('administrar.politico.index', compact('politicos'));
    }

    public function create()
    {
        return view('administrar.politico.create');
    }

    public function store(PoliticoRequest $request)
    {
        $verificaCPF = $this->politicoRepository->findWhere(['cpf' => $request->get('cpf')]);

        if($verificaCPF->count()){

            Session::flash('error', 'Cpf já cadastrado no sistema');

            return redirect()->back();
        }

        $dados = $request->all();
        $foto = $request->file('foto');

        if($foto){
            $nome = Carbon::now()->format('dmYHis') . uniqid();
            $extensao = $request->foto->extension();
            $nomeArquivo = "{$nome}.{$extensao}";

            $dados['foto'] = $nomeArquivo;

            $politico = $this->politicoRepository->create($dados);

            $upload = $foto->storeAs('politico', $nomeArquivo);

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload de imagem');
            }

            $dados['link_foto'] = "";
        }else{
            $dados['foto'] = "";
            $politico = $this->politicoRepository->create($dados);
        }

        $mensagem = $politico->nome . " cadastrado(a) com sucesso";

        Session::flash('mensagem', $mensagem);

        return redirect()->route('politico.create');
    }

    public function editFoto($id)
    {
        $politico = $this->politicoRepository->find($id);

        return view('administrar.politico.edit-foto', compact('politico'));
    }

    public function updateFoto(UpdateFotoRequest $request, $id)
    {
        if($request->file('foto') && $request->get('link_foto')){
            Session::flash('error', 'Escolha somente um campo para foto');
            return redirect()->back();
        }

        $dados = $request->all();
        $foto = $request->file('foto');

        $politico = $this->politicoRepository->find($id);

        if($politico->foto){
            Storage::delete('politico/'.$politico->foto);
        }

        if($foto){
            $nome = Carbon::now()->format('dmYHis') . uniqid();
            $extensao = $request->foto->extension();
            $nomeArquivo = "{$nome}.{$extensao}";
            $dados['foto'] = $nomeArquivo;

            $upload = $foto->storeAs('politico', $nomeArquivo);

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload de imagem');
            }

            $dados['link_foto'] = "";
        }else{
            $dados['foto'] = "";
        }

        $this->politicoRepository->update($dados, $id);

        Session::flash('mensagem', 'Foto alterada com sucesso');

        return redirect()->route('politico.editFoto', $id);
    }

    public function edit($id)
    {
        $politico = $this->politicoRepository->find($id);

        return view('administrar.politico.edit', compact('politico'));
    }

    public function update(PoliticoEditRequest $request, $id)
    {
        $this->politicoRepository->update($request->all(), $id);
        Session::flash('mensagem', 'Dados alterados com sucesso');

        return redirect()->route('politico.edit', $id);
    }


    public function destroy($id)
    {
        $politico = $this->politicoRepository->find($id);
        $politicoEleicao = $this->politicoEleicaoRepository->findWhere(['politico_id' => $politico->id]);
        $mensagem = $politico->nome . ' excluído(a) com sucesso';

        if ($politicoEleicao){
            foreach ($politicoEleicao as $eleicao){
                $this->politicoEleicaoRepository->delete($eleicao->id);
            }
        }

        $this->politicoRepository->delete($id);

        if($politico->foto){
            Storage::delete('politico/'.$politico->foto);
        }

        Session::flash('mensagem', $mensagem);

        return redirect()->route('politico.index');
    }

    public function getPoliticosCidade(CidadeRequest $request)
    {
        $presidenteCoordenadores = $this->presidenteCoordenadorRepository->findByField('cidade_id', $request->get('cidade'));
        $politicos = $this->politicoRepository->findByField('cidade_id', $request->get('cidade'));

        $cidades = $this->cidadeRepository->all();

        $presidenteCoordenadores = $presidenteCoordenadores->sortBy('tipo_id');
        $politicos = $politicos->sortBy('cargo_id');

        return view('politico.index', compact('politicos','cidades', 'presidenteCoordenadores'));
    }

    public function getPoliticosCidadeJson($cidade)
    {
        $politicos = $this->politicoRepository->findByField('cidade_id', $cidade);
        $politicos = $politicos->sortBy('cargo_id');

        return Response::json($politicos);
    }
}
