@extends('Layouts.Admin.merge')
@section('titulo', 'Pacientes | Painel de Gestão da Maternidade')

@section('conteudo')

    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 font-weight-bold text-primary">Pacientes que deram entrada na maternidade</h6>
                        </div>
                        <div>
                            @if (Auth::user()->acesso == 1)
                            <a href="#" data-toggle="modal" data-target="#add" class="btn btn-primary">Registrar</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card mb-4 p-4">
                    <div class="table-responsive p-4">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Bilhete</th>
                                    <th>Peso</th>
                                    <th>Entrada</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pacientes as $paciente)
                                    <tr>
                                        <td>{{ $paciente->nome }}</td>
                                        <td>{{ $paciente->telefone }}</td>
                                        <td>{{ $paciente->bi_cedula }}</td>
                                        <td>{{ $paciente->peso }}</td>
                                        <td>{{ date('d/m/Y', strtotime($paciente->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-outline-primary" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i style="font-size: .4rem;" class="fa fa-dot-circle"></i>
                                                    <i style="font-size: .4rem;" class="fa fa-dot-circle"></i>
                                                    <i style="font-size: .4rem;" class="fa fa-dot-circle"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @if (Auth::user()->acesso == 1)
                                                    <li>
                                                        <a class="dropdown-item text-danger" data-toggle="modal"
                                                            data-target="#delete{{ $paciente->id }}" href="#">
                                                            <i class="fa fa-trash"></i> Eliminar
                                                        </a>
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <a class="dropdown-item text-primary" data-toggle="modal"
                                                            data-target="#editar{{ $paciente->id }}" href="#">
                                                            <i class="fa fa-pen"></i> Editar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="delete{{ $paciente->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="deleteTitle{{ $paciente->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white"
                                                        id="deleteTitle{{ $paciente->id }}">Operação de
                                                        limpeza</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body row">
                                                    <div class="col-lg-12 text-center form-group mb-3">
                                                        <label for="nome" style="font-weight: 600;">Pretende realmente
                                                            apagar o registro?</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-primary"
                                                        data-dismiss="modal">Fechar</button>
                                                    <a href="{{ route('pacientes.delete', ['id' => $paciente->id]) }}" id="btnDelete"
                                                        class="btn btn-danger">Apagar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- DataTable with Hover -->
        </div>
    </div>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <form action="{{ route('pacientes.registro') }}" id="formulario" method="post" class="modal-content">
                @csrf
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="addTitle">Cadastrando um paciente</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="nome" style="font-weight: 700; color: #000;">Informações Pessoais</label>
                            <hr>
                        </div>
                        <div class="col-lg-8 form-group mb-3">
                            <label for="nome" style="font-weight: 600;">Nome completo</label>
                            <input type="text" name="nome" id="nome" class="form-control">
                        </div>
                        <div class="col-lg-4 form-group mb-3">
                            <label for="telefone" style="font-weight: 600;">Telefone</label>
                            <input type="tel" name="telefone" id="telefone" class="form-control">
                        </div>
                        <div class="col-lg-5 form-group mb-3">
                            <label for="telefone_emergencia" style="font-weight: 600;">Telefone de Emergência</label>
                            <input type="tel" name="telefone_emergencia" id="telefone_emergencia" class="form-control">
                        </div>
                        <div class="col-lg-7 form-group mb-3">
                            <label for="bi_cedula" style="font-weight: 600;">BI ou Cédula</label>
                            <input type="text" name="bi_cedula" id="bi_cedula" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <hr>
                            <label for="nome" style="font-weight: 700; color: #000;">Informações Médicas</label>
                            <hr>
                        </div>
                        <div class="col-lg-4 form-group mb-3">
                            <label for="idade_gestacional" style="font-weight: 600;">Idade Gestacional</label>
                            <input type="text" name="idade_gestacional" id="idade_gestacional" class="form-control">
                        </div>
                        <div class="col-lg-4 form-group mb-3">
                            <label for="peso" style="font-weight: 600;">Peso</label>
                            <input type="text" name="peso" id="peso" class="form-control">
                        </div>
                        <div class="col-lg-4 form-group mb-3">
                            <label for="altura" style="font-weight: 600;">Altura</label>
                            <input type="text" name="altura" id="altura" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label for="historico" style="font-weight: 600;">Histórico Médico</label>
                            <textarea name="historico" id="historico" cols="8" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label for="alergias" style="font-weight: 600;">Descreva as alergias do paciente</label>
                            <textarea name="alergias" id="alergias" cols="4" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-3 form-group mb-3">
                            <label for="horario_admissao" style="font-weight: 600;">Horário de Admissão</label>
                            <input type="time" name="horario_admissao" id="horario_admissao" class="form-control">
                        </div>
                        <div class="col-lg-3 form-group mb-3">
                            <label for="inicio_trabalho_parto" style="font-weight: 600;">Ínicio do trabalho de parto</label>
                            <input type="time" name="inicio_trabalho_parto" id="inicio_trabalho_parto" class="form-control">
                        </div>
                        <div class="col-lg-3 form-group mb-3">
                            <label for="contracoes" style="font-weight: 600;">Contrações</label>
                            <input type="text" name="contracoes" id="contracoes" class="form-control">
                        </div>
                        <div class="col-lg-3 form-group mb-3">
                            <label for="batimentos" style="font-weight: 600;">Batimentos</label>
                            <input type="text" name="batimentos" id="batimentos" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label for="medicamentos" style="font-weight: 600;">Medicamentos administrados</label>
                            <textarea name="medicamentos" id="medicamentos" cols="4" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label for="exame" style="font-weight: 600;">Descreva o exame da paciente</label>
                            <textarea name="exame" id="exame" cols="4" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label for="observacoes" style="font-weight: 600;">Observações</label>
                            <textarea name="observacoes" id="observacoes" cols="4" rows="4" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('paciente.create.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Cadastro com sucesso',
                text: 'Pacientes registrado com sucesso',
                timer: 6500
            })
        </script>
    @endif
    @if (session('paciente.create.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro cadastro!',
                text: 'Falha ao cadastrar o pacientes',
                timer: 6500
            })
        </script>
    @endif

    @if (session('paciente.delete.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Pacientes apagado com sucesso',
                timer: 6500
            })
        </script>
    @endif

    @if (session('paciente.delete.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Falha ao apagar o pacientes',
                timer: 6500
            })
        </script>
    @endif

    @if (session('paciente.estado.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Estado do pacientes atualizado com sucesso',
                timer: 6500
            })
        </script>
    @endif

    @if (session('paciente.estado.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Falha ao atualizar o estado do pacientes',
                timer: 6500
            })
        </script>
    @endif

    @if (session('paciente.update.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Informações do pacientes atualizadas com sucesso',
                timer: 6500
            })
        </script>
    @endif

    @if (session('paciente.update.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Falha ao atualizar as informações do pacientes',
                timer: 6500
            })
        </script>
    @endif


@endsection
