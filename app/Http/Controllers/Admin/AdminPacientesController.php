<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {


            $pacientes = pacientes::all();
            return view('Admin.paciente', compact('pacientes'));

        } else {
            return view('Admin.home');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            //Cadastrando as informações do Admin na base de dados
            $paciente = new  pacientes();

            $paciente->nome = $request->nome;
            $paciente->telefone = $request->telefone;
            $paciente->telefone_emergencia = $request->telefone_emergencia;
            $paciente->bi_cedula = $request->bi_cedula;
            $paciente->idade_gestacional = $request->idade_gestacional;
            $paciente->peso = $request->peso;
            $paciente->altura = $request->altura;
            $paciente->historico = $request->historico;
            $paciente->alergias = $request->alergias;
            $paciente->horario_admissao = $request->horario_admissao;
            $paciente->inicio_trabalho_parto = $request->inicio_trabalho_parto;
            $paciente->contracoes = $request->contracoes;
            $paciente->batimentos = $request->batimentos;
            $paciente->medicamentos = $request->medicamentos;
            $paciente->exame = $request->exame;
            $paciente->observacoes = $request->observacoes;

            $paciente->save();

            //dd($d);
            return redirect()->back()->with('paciente.create.success',1);


        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->back()->with('paciente.create.error',1);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            //Cadastrando as informações do Admin na base de dados
            $paciente = pacientes::where('id', $id)->first();

            $paciente->update([
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'telefone_emergencia' => $request->telefone_emergencia,
                'bi_cedula' => $request->bi_cedula,
                'idade_gestacional' => $request->idade_gestacional,
                'peso' => $request->peso,
                'altura' => $request->altura,
                'historico' => $request->historico,
                'alergias' => $request->alergias,
                'horario_admissao' => $request->horario_admissao,
                'inicio_trabalho_parto' => $request->inicio_trabalho_parto,
                'contracoes' => $request->contracoes,
                'batimentos' => $request->batimentos,
                'medicamentos' => $request->medicamentos,
                'exame' => $request->exame,
                'observacoes' => $request->observacoes,
            ]);

            //dd($d);
            return redirect()->back()->with('paciente.update.success',1);

        } catch (\Throwable $th) {

            //throw $th;
            //dd($d);
            return redirect()->back()->with('paciente.update.error',1);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id, string $idusuario)
    {
        try {

            $paciente = pacientes::where('id', $id);

            if ($paciente->foto != null)
            {
                 //Apagar a foto de perfil do pacien$paciente
                $fotoPerfil = $paciente->foto;

                // Construir o caminho completo do arquivo
                $caminhoArquivo = public_path('/uploads/') . $fotoPerfil;

                // Verificar se o arquivo existe antes de tentar excluí-lo
                if (file_exists($caminhoArquivo)) {
                    // Excluir o arquivo
                    unlink($caminhoArquivo);
                }
            }

            $paciente->delete();

            return redirect()->back()->with('paciente.delete.success', 1);

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('paciente.delete.error', 1);
        }
    }
}
