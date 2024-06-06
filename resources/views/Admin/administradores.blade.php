@extends('Layouts.Admin.merge')
@section('titulo', 'Administradores | Painel de Gestão da Maternidade')

@section('conteudo')

    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 font-weight-bold text-primary">Administradores Gerais</h6>
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
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->telefone }}</td>
                                        <td>
                                            @if ($admin->estado == 1)
                                                <span class="badge badge-success">Online</span>
                                            @else
                                                <span class="badge badge-dark">Offline</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($admin->created_at)) }}</td>
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
                                                            data-target="#delete{{ $admin->id }}" href="#">
                                                            <i class="fa fa-trash"></i> Eliminar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-primary" data-toggle="modal"
                                                            data-target="#editar{{ $admin->id }}" href="#">
                                                            <i class="fa fa-pen"></i> Editar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editar{{ $admin->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="editarTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <form action="{{ route('admin.registro') }}" enctype="multipart/form-data" method="post" id="formulario" class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="editarTitle">Editando informações do admin</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @csrf
                                                        <div class="col-lg-12 form-group mb-3">
                                                            <label for="nome" style="font-weight: 600;">Nome
                                                                completo</label>
                                                            <input type="text" name="nome" id="nome"
                                                                class="form-control" value="{{ $admin->name }}">
                                                        </div>
                                                        <div class="col-lg-12 form-group mb-3">
                                                            <label for="telefone" style="font-weight: 600;">Telefone</label>
                                                            <input type="tel" name="telefone" id="telefone"
                                                                class="form-control" value="{{ $admin->telefone }}">
                                                        </div>
                                                        <div class="col-lg-12 form-group mb-3">
                                                            <label for="email" style="font-weight: 600;">Email</label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control" value="{{ $admin->email }}">
                                                        </div>
                                                        <div class="col-lg-12 form-group mb-3">
                                                            <label for="foto">Foto de perfil</label>
                                                            <input type="file" name="foto" id="foto"
                                                                class="form-control">
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

                                    <div class="modal fade" id="delete{{ $admin->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="deleteTitle{{ $admin->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white"
                                                        id="deleteTitle{{ $admin->id }}">Operação de
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
                                                    <a href="{{ route('admin.delete', $admin->id) }}" id="btnDelete"
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
            <form action="{{ route('admin.registro') }}" enctype="multipart/form-data" method="post" id="formulario"
                class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="addTitle">Cadastrando novo
                        administrador</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <div class="col-lg-12 form-group mb-3">
                            <label for="nome" style="font-weight: 600;">Nome
                                completo</label>
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
                            <label for="foto">Foto de perfil</label>
                            <input type="file" name="foto" id="foto" class="form-control">
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
    @if (session('img.create.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro Upload',
                text: 'Apenas arquivos de imagem são permitidos',
                timer: 3000
            })
        </script>
    @endif
    @if (session('admin.create.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Cadastro com sucesso',
                text: 'Administrador registrado com sucesso',
                timer: 3000
            })
        </script>
    @endif
    @if (session('admin.create.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro cadastro!',
                text: 'Falha ao cadastrar o admin',
                timer: 3000
            })
        </script>
    @endif

    @if (session('admin.delete.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Administrador apagado com sucesso',
                timer: 3000
            })
        </script>
    @endif

    @if (session('admin.delete.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Falha ao apagar o administrador',
                timer: 3000
            })
        </script>
    @endif

    @if (session('admin.estado.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Estado do administrador atualizado com sucesso',
                timer: 3000
            })
        </script>
    @endif

    @if (session('admin.estado.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Falha ao atualizar o estado do administrador',
                timer: 3000
            })
        </script>
    @endif

    @if (session('admin.update.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Informações do administrador atualizadas com sucesso',
                timer: 3000
            })
        </script>
    @endif

    @if (session('admin.update.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Falha ao atualizar as informações do administrador',
                timer: 3000
            })
        </script>
    @endif


@endsection
