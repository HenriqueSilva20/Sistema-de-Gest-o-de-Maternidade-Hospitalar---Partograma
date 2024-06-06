<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\recepcionistas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRecepcionistasController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::check() && Auth::User()->acesso == 1) {

            $recepcionistas = recepcionistas::all();
            return view('Admin.recepcionista', compact('recepcionistas'));

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

            //Adicionando outras informações do admin na tabela usuários
            $user = new User();

            $password = "recepcionista";
            $user->name = $request->nome;
            $user->email = $request->email;
            $user->telefone = $request->telefone;
            $user->estado = 0;
            $user->acesso = 3;
            $user->perfil = "recepcionista";
            $user->password = Hash::make($password);

            $user->save();

            //ID do ultimo registro inserido
            $id = $user->id;

            //Cadastrando as informações do Admin na base de dados
            $recepcionista = new  recepcionistas();

            $recepcionista->idusuario = $id;
            $recepcionista->bilhete = $request->bilhete;
            $recepcionista->comeco_turno = $request->comeco_turno;
            $recepcionista->fim_turno = $request->fim_turno;

            $recepcionista->save();

            //dd($d);
            return redirect()->back()->with('recepcionista.create.success',1);


        } catch (\Throwable $th) {
            //throw $th;
            //dd($d);
            return redirect()->back()->with('recepcionista.create.error',1);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id, string $idusuario)
    {
        try {

            $recepcionista = recepcionistas::where('id', $id);
            $admin = User::findOrFail($idusuario);

            if ($admin->foto != null)
            {
                 //Apagar a foto de perfil do admin
                $fotoPerfil = $admin->foto;

                // Construir o caminho completo do arquivo
                $caminhoArquivo = public_path('/uploads/') . $fotoPerfil;

                // Verificar se o arquivo existe antes de tentar excluí-lo
                if (file_exists($caminhoArquivo)) {
                    // Excluir o arquivo
                    unlink($caminhoArquivo);
                }
            }

            $recepcionista->delete();
            $admin->delete();

            return redirect()->back()->with('recepcionista.delete.success', 1);

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('recepcionista.delete.error', 1);
        }
    }
}
