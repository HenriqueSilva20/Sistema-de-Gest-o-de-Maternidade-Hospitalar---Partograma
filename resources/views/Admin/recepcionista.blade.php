@extends('Layouts.Admin.merge')
@section('titulo', 'Recepionistas | Painel de Gestão da Maternidade')

@section('conteudo')
    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 font-weight-bold text-primary">Recepcionistas</h6>
                        </div>
                        <div>
                            <a href="#" data-toggle="modal" data-target="#add" class="btn btn-primary">Cadastrar</a>
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
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Estado</th>
                                    <th>Cadastro</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recepcionistas as $recepcionista)
                                <?php $userdata = app('App\Http\Controllers\Admin\AdminAdministradorController')->admin_data($recepcionista->idusuario); ?>
                                    <tr>
                                        <td>{{ $userdata->name }}</td>
                                        <td>{{ $userdata->email }}</td>
                                        <td>{{ $userdata->telefone }}</td>
                                        <td>
                                            @if ($userdata->estado == 1)
                                                <span class="badge badge-success">Online</span>
                                            @else
                                                <span class="badge badge-dark">Offline</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($recepcionista->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-outline-primary" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i style="font-size: .4rem;" class="fa fa-dot-circle"></i>
                                                    <i style="font-size: .4rem;" class="fa fa-dot-circle"></i>
                                                    <i style="font-size: .4rem;" class="fa fa-dot-circle"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item text-danger" data-toggle="modal"
                                                            data-target="#delete{{ $recepcionista->id }}" href="#">
                                                            <i class="fa fa-trash"></i> Eliminar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-primary" data-toggle="modal"
                                                            data-target="#editar{{ $recepcionista->id }}" href="#">
                                                            <i class="fa fa-pen"></i> Editar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editar{{ $recepcionista->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="editarTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <form action="{{ route('recepcionistas.update', ['id' => $recepcionista->id, 'idusuario' => $recepcionista->idusuario]) }}" method="post" class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="editarTitle">Editando informações do(a) recepcionista
                                                    </h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 form-group mb-3">
                                                            <label for="nome" style="font-weight: 600;">Nome
                                                                completo</label>
                                                            <input type="text" name="nome" id="nome"
                                                                class="form-control" value="{{ $userdata->name }}">
                                                        </div>
                                                        <div class="col-lg-12 form-group mb-3">
                                                            <label for="telefone" style="font-weight: 600;">Telefone</label>
                                                            <input type="tel" name="telefone" id="telefone"
                                                                class="form-control"  value="{{ $userdata->telefone }}">
                                                        </div>
                                                        <div class="col-lg-12 form-group mb-3">
                                                            <label for="email" style="font-weight: 600;">Email</label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control" value="{{ $userdata->email }}">
                                                        </div>
                                                        <div class="col-lg-12 form-group mb-3">
                                                            <label for="bilhete" style="font-weight: 600;">Bilhete de
                                                                Identidade</label>
                                                            <input type="text" name="bilhete" id="bilhete"
                                                                class="form-control" value="{{ $recepcionista->bilhete }}">
                                                        </div>
                                                        <div class="col-lg-12 form-group mb-3">
                                                            <label for="comeco_turno" style="font-weight: 600;">Ínicio do Turno</label>
                                                            <input type="time" name="comeco_turno" id="comeco_turno" value="{{ $recepcionista->comeco_turno }}" class="form-control">
                                                        </div>
                                                        <div class="col-lg-12 form-group mb-3">
                                                            <label for="fim_turno" style="font-weight: 600;">Fim do Turno</label>
                                                            <input type="time" name="fim_turno" id="fim_turno" value="{{ $recepcionista->fim_turno }}" class="form-control">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-primary"
                                                        data-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="delete{{ $recepcionista->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="deleteTitle{{ $recepcionista->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white"
                                                        id="deleteTitle{{ $recepcionista->id }}">Operação de
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
                                                    <a href="{{ route('medico.delete', ['id' => $recepcionista->id, 'idusuario' => $recepcionista->idusuario]) }}" id="btnDelete"
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
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <form action="{{ route('recepcionistas.registro') }}" id="formulario" method="post" class="modal-content">
                @csrf
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="addTitle">Cadastrando Recepcionista</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 form-group mb-3">
                            <label for="nome" style="font-weight: 600;">Nome completo</label>
                            <input type="text" name="nome" id="nome" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label for="telefone" style="font-weight: 600;">Telefone</label>
                            <input type="tel" name="telefone" id="telefone" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label for="email" style="font-weight: 600;">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label for="bilhete" style="font-weight: 600;">Bilhete de Identidade</label>
                            <input type="text" name="bilhete" id="bilhete" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label for="comeco_turno" style="font-weight: 600;">Ínicio do Turno</label>
                            <input type="time" name="comeco_turno" id="comeco_turno" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label for="fim_turno" style="font-weight: 600;">Fim do Turno</label>
                            <input type="time" name="fim_turno" id="fim_turno" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('recepcionista.create.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Cadastro com sucesso',
                text: 'Recepcionista registrado com sucesso',
                timer: 3000
            })
        </script>
    @endif
    @if (session('recepcionista.create.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro cadastro!',
                text: 'Falha ao cadastrar o recepcionista',
                timer: 3000
            })
        </script>
    @endif

    @if (session('recepcionista.delete.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Recepcionista apagado com sucesso',
                timer: 3000
            })
        </script>
    @endif

    @if (session('recepcionista.delete.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Falha ao apagar o recepcionista',
                timer: 3000
            })
        </script>
    @endif

    @if (session('recepcionista.estado.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Estado do recepcionista atualizado com sucesso',
                timer: 3000
            })
        </script>
    @endif

    @if (session('recepcionista.estado.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Falha ao atualizar o estado do recepcionista',
                timer: 3000
            })
        </script>
    @endif

    @if (session('recepcionista.update.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Informações do recepcionista atualizadas com sucesso',
                timer: 3000
            })
        </script>
    @endif

    @if (session('recepcionista.update.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Falha ao atualizar as informações do recepcionista',
                timer: 3000
            })
        </script>
    @endif

@endsection
