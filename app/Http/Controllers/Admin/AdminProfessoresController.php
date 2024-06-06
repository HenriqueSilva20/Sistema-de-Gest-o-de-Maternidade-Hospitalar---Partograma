<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\professores;
use Illuminate\Http\Request;

class AdminProfessoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response['professores'] = professores::all();
        return view('Admin.professores', $response);
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

            //dd($request);

            $professores = new professores();

            // Validar e fazer upload da imagem
            if ($request->hasFile('foto')) {
                $imagemFile = $request->file('foto');

                // Validar a extensão do arquivo de imagem
                $imagemExtension = $imagemFile->getClientOriginalExtension();
                $imagemName = $imagemFile->getClientOriginalName();
                $allowedImagemExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array($imagemExtension, $allowedImagemExtensions)) {
                    return redirect()->back()->with('professores.foto.error', 1);
                }

                $imagemPath = public_path('/uploads/professores/fotos/');
                $imagemFile->move($imagemPath, $imagemName);

                // Salvar o nome da imagem no banco de dados
                $professores->foto = $imagemName;
            }

            $professores->nome = $request->nome;
            $professores->email = $request->email;
            $professores->telefone = $request->telefone;
            $professores->formacao = $request->formacao;
            $professores->pais = $request->pais;
            $professores->verificado = $request->verificado;
            //$professores->biografia = $request->biografia;

            $professores->save();

            return redirect()->back()->with('professores.create.success', 1);

        } catch (\Throwable $th) {

            //throw ($th);
            dd ($th);

            return redirect()->back()->with('professores.create.error', 1);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response['professor'] = professores::findOrFail($id);
        return view('Admin.professores', $response);
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
            $professores = professores::findOrFail($id);

            // Validar e fazer upload da imagem
            if ($request->hasFile('foto')) {

                // Validar a extensão do arquivo de imagem
                $imagemFile = $request->file('foto');
                $imagemExtension = $imagemFile->getClientOriginalExtension();
                $imagemName = $imagemFile->getClientOriginalName();
                $allowedImagemExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array($imagemExtension, $allowedImagemExtensions)) {
                    return redirect()->back()->with('professores.foto.error', 1);
                }

                $imagemPath = public_path('/uploads/professores/fotos/');
                $imagemFile->move($imagemPath, $imagemName);

                // Salvar o nome da imagem no banco de dados
                $professores->foto = $imagemName;
            }

            $professores->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'formacao' => $request->formacao,
                'pais' => $request->pais,
                'verificado' => $request->verificado,
                //'biografia' => $request->biografia,
            ]);

            return redirect()->back()->with('professores.update.success', 1);

        } catch (\Throwable $th) {

            //throw ($th);
            //dd ($request);

            return redirect()->back()->with('professores.update.error', 1);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $professores = professores::findOrFail($id);

            if ($professores->foto != null) {
                //Apagar o vídeo antigo do registro a ser atualizado
                $oldVideo = public_path('/uploads/professores/fotos/') . $professores->foto;
                if (file_exists($oldVideo)) {
                    unlink($oldVideo);
                }
            }

            $professores->delete();

            return redirect()->back()->with('professores.delete.success', 1);

        } catch (\Throwable $th) {

            //throw ($th);
            dd ($th);

            return redirect()->back()->with('professores.delete.error', 1);
        }
    }
}
