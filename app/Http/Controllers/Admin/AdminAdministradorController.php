<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check() && Auth::User()->acesso == 1) {
            $admins = User::where('acesso', 1)->paginate(8);
            return view('Admin.administradores', compact('admins'));
        } else {
            return view('Admin.home');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        //dd($req);
        /*$req->validate([
            'nome' => 'required|max:255|min:6',
            'email' => 'email|unique:users|required',
            'telefone' => 'required|max:15|min:10',
            'password' => 'required|min:3',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'nome.min' => 'O campo nome deve ter no mínimo 6 caracteres.',
            'email.email' => 'Este email deve ser válido.',
            'email.unique' => 'O campo email já está em uso.',
            'email.required' => 'O campo email é obrigatório.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.max' => 'O campo telefone deve ter no maximo 15 caracteres.',
            'telefone.min' => 'O campo telefone deve ter no minimo 10 caracteres.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve ter no mínimo 3 caracteres.',
        ]);
        */

        try {

            //dd($req);

            // Verifica se a foto é uma imagem
            $file = $req->foto;
            $extension = $file->getClientOriginalExtension();
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            if (!in_array($extension, $allowedExtensions)) {
                return redirect()->back()->with('img.create.error', 1);
            }

            // Faz o upload da foto
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/uploads/'), $fileName);
            $password = "admin";

            $d = DB::table('users')->insert([
                'name'=> $req->nome,
                'email'=> $req->email,
                'telefone'=> $req->telefone,
                'estado'=> 0,
                'foto' => $fileName,
                'password' => Hash::make($password),
            ]);

            //dd($d);
            return redirect()->back()->with('admin.create.success',1);

        } catch (\Throwable $th) {
            //throw $th;
            //dd($req);
            return redirect()->back()->with('admin.create.error',1);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response['admin'] = User::findOrFail($id);
        return view('Admin.admin', $response);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return response()->json($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            //dd($request);
            $admin = User::findOrFail($id);

            if ($request->foto != null)
            {

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

                $file = $request->foto;
                $extension = $file->getClientOriginalExtension();
                $allowedExtensions = ['jpg', 'jpeg', 'png'];

                if (!in_array($extension, $allowedExtensions)) {
                    return redirect()->back()->with('img.create.error', 1);
                }

                // Faz o upload da foto
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/uploads/'), $fileName);

                DB::table('users')->where('id', $id)->update([
                    'name' => $request->nome,
                    'email' => $request->email,
                    'telefone' => $request->telefone,
                    'foto' => $fileName,
                ]);

                //dd($request);
                return redirect()->back()->with('admin.update.success', 1);

            } else {

                DB::table('users')->where('id', $id)->update([
                    'name' => $request->nome,
                    'email' => $request->email,
                    'telefone' => $request->telefone,
                ]);

                //dd($request);
                return redirect()->back()->with('admin.update.success', 1);

            }

        } catch (\Throwable $th) {
            // throw $th;
            // dd ($th);
            return redirect()->back()->with('admin.update.error', 1);
        }
    }

    public function estado($id, $estado)
    {

        try {
            $admin = User::findOrFail($id);
            $admin->estado = $estado;
            $admin->save();

            return redirect()->back()->with('admin.estado.success', 1);

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('admin.estado.error', 1);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {

            $admin = User::findOrFail($id);

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

            $admin->delete();

            return redirect()->back()->with('admin.delete.success', 1);

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('admin.delete.error', 1);
        }
    }

    public function admin_data(string $id)
    {
        $user = User::where('id', $id)->first();
        return $user;
    }

}
