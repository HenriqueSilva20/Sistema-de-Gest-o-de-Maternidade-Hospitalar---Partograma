<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\compras;
use App\Models\ctf;
use App\Models\desafios_ctf;
use App\Models\labvirtual;
use App\Models\medicos;
use App\Models\modulos;
use App\Models\noticiais;
use App\Models\pacientes;
use App\Models\recepcionistas;
use App\Models\reclamacoes;
use App\Models\treinamentos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {

            $home = "home";

            //Pegar o total de médicos cadastrados na BD
            $medicos = medicos::all();

            //Pegar o total de pacientes cadastrados na BD
            $pacientes = pacientes::all();

            //Pegar o total de recepcionistas cadastrados na BD
            $recepcionistas = recepcionistas::all();

            //Pegar o total de administradores cadastrados na BD
            $admins = User::where('acesso', 1)->get();

            return view('Admin.home', compact('home', 'medicos', 'pacientes', 'recepcionistas', 'admins'));
        } else {
            return view('plataforma');
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
        //
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
    public function destroy(string $id)
    {
        //
    }
}
