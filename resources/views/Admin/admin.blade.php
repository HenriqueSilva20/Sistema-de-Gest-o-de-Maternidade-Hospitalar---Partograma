@extends('Layouts.Admin.merge')
@section('titulo', 'Administradores | Vaysoft')

@section('conteudo')

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">

                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between">
                                <div class="mt-2 fw-bold"><h4 style="font-weight: 700;">Administradores do sistema</h4></div>
                                <div>
                                    <a href="#" data-toggle="modal" data-target="#cadastrarAdmin" class="btn btn-primary">Cadastrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    @if(isset($admins) && !empty($admins))
                        @foreach ($admins as $admin)
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                    <img src="/uploads/fotos/{{ $admin->foto }}" style="border-radius: 50%; width: 20vh; height: 20vh; object-fit: cover; object-position: top;" alt="">
                                    <div class="d-flex flex-column justify-content-center p-2 mt-3 align-items-center">
                                        <h4 style="font-size: .9rem;">{{ $admin->name }}</h4>
                                        <div class="mt-3">
                                            <a href="#" data-admin-id="{{ $admin->id }}" data-toggle="modal" data-target="#editAdmin{{ $admin->id }}" class="btn btn-info btn-edit-admin"><i class="text-white fa fa-edit"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#deleteAdmin{{ $admin->id }}" class="btn btn-danger"><i class="text-white fa fa-trash"></i></a>
                                            @if ($admin->estado == 0 || $admin->estado == 1)
                                            <a href="#" data-toggle="modal" data-target="#blockAdmin{{ $admin->id }}" class="btn btn-primary">
                                                <i class="text-white fa fa-unlock"></i>
                                            </a>
                                            @elseif ($admin->estado == 2)
                                            <a href="#" data-toggle="modal" data-target="#desblockAdmin{{ $admin->id }}" class="btn btn-success">
                                                <i class="text-white fa fa-lock"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal - Calendar - Add New Event -->
                        <div class="modal fade none-border" id="editAdmin{{$admin->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><strong>Editar dados do admin</strong></h4>
                                    </div>
                                    <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12 form-group mb-3">
                                                    <label for="nome">Nome completo</label>
                                                    <input type="text" name="nome" id="nome" value="{{ $admin->name }}" class="form-control">
                                                </div>
                                                <div class="col-lg-12 form-group mb-3">
                                                    <label for="telefone">Nº de Telefone</label>
                                                    <input type="tel" name="telefone" id="telefone"  value="{{ $admin->telefone }}" class="form-control">
                                                </div>
                                                <div class="col-lg-12 form-group mb-3">
                                                    <label for="email">Endereço de email</label>
                                                    <input type="email" name="email" id="email"  value="{{ $admin->email }}" class="form-control">
                                                </div>
                                                <div class="col-lg-12 form-group mb-3">
                                                    <label for="foto">Foto de perfil</label>
                                                    <input type="file" name="foto" id="foto" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-close"></i>Fechar</button>
                                            <button type="submit" class="btn btn-success save-event waves-effect waves-light"> <i class="fa fa-save"></i> Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /#event-modal -->

                        <!-- Modal - Calendar - Add New Event -->
                        <div class="modal fade none-border p-4" id="blockAdmin{{ $admin->id }}">
                            <div class="modal-dialog modal-center">
                                <div class="modal-content p-4">
                                    <div class="modal-header d-flex justify-content-center align-items-center text-center">
                                        <h4 class="modal-title"><strong>Pretende continuar e bloquear o admin?</strong></h4>
                                    </div>
                                    <div class="modal-footer p-4 d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                                        <a href="{{ route('admin.estado', ['id' =>  $admin->id, 'estado' => 2]) }}" class="btn btn-danger delete-event waves-effect waves-light">Bloquear</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /#event-modal -->

                        <!-- Modal - Calendar - Add New Event -->
                        <div class="modal fade none-border p-4" id="desblockAdmin{{ $admin->id }}">
                            <div class="modal-dialog modal-center">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center align-items-center text-center">
                                        <h4 class="modal-title"><strong>Pretende continuar e desbloquear o admin?</strong></h4>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                                        <a href="{{ route('admin.estado',['id' =>  $admin->id, 'estado' => 0]) }}" class="btn btn-danger delete-event waves-effect waves-light">Desbloquear</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /#event-modal -->

                        <!-- Modal - Calendar - Add New Event -->
                        <div class="modal fade none-border p-4" id="deleteAdmin{{ $admin->id }}">
                            <div class="modal-dialog modal-center">
                                <div class="modal-content">
                                    <div class="modal-header p-4 d-flex justify-content-center align-items-center text-center">
                                        <h4 class="modal-title"><strong>Pretende continuar e apagar o admin?</strong></h4>
                                    </div>
                                    <div class="modal-footer p-4 d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                                        <a href="{{ route('admin.delete', $admin->id) }}" class="btn btn-danger delete-event waves-effect waves-light">Apagar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /#event-modal -->

                        @endforeach
                    @endif

                    <div class="col-lg-12">

                        @if ($admins->total() > 0)
                            <nav class="d-flex justify-content-center" style="margin-top: 50px" aria-label="Page navigation example">
                                <ul class="pagination">
                                    {{-- Botão para a página anterior --}}
                                    @if ($admins->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Recuar</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $admins->previousPageUrl() }}">Recuar</a>
                                        </li>
                                    @endif

                                    {{-- Links de páginas --}}
                                    @for ($i = 1; $i <= $admins->lastPage(); $i++)
                                        <li class="page-item {{ $admins->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $admins->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Botão para a próxima página --}}
                                    @if ($admins->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $admins->nextPageUrl() }}">Avançar</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">Avançar</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif

                    </div>

                </div>
                <!-- /Widgets -->

                <!-- Modal - Calendar - Add New Event -->
                <div class="modal fade none-border" id="cadastrarAdmin">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Cadastrando admin</strong></h4>
                            </div>
                            <form action="{{ route('admin.registro') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12 form-group mb-3">
                                            <label for="foto">Nome completo</label>
                                            <input type="text" name="nome" id="nome" placeholder="" class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 form-group mb-3">
                                            <label for="foto">Nº de Telefone</label>
                                            <input type="tel" name="telefone" id="telefone" placeholder="" class="form-control @error('telefone') is-invalid @enderror">
                                            @error('telefone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 form-group mb-3">
                                            <label for="foto">Endereço de email</label>
                                            <input type="email" name="email" id="email" placeholder="" class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 form-group mb-3">
                                            <label for="foto">Foto de perfil</label>
                                            <input type="file" name="foto" id="foto" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-close"></i>Fechar</button>
                                    <button type="submit" class="btn btn-success save-event waves-effect waves-light"> <i class="fa fa-save"></i> Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /#event-modal -->


            <!-- /#add-category -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('img.create.error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro Upload',
                    text: 'Apenas arquivos de imagem são permitidos',
                    timer: 3000
                })
            </script>
        @endif
        @if(session('admin.create.success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Cadastro com sucesso',
                    text: 'Administrador registrado com sucesso',
                    timer: 3000
                })
            </script>
        @endif
        @if(session('admin.create.error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro cadastro!',
                    text: 'Falha ao cadastrar o admin',
                    timer: 3000
                })
            </script>
        @endif

        @if(session('admin.delete.success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Administrador apagado com sucesso',
                    timer: 3000
                })
            </script>
        @endif

        @if(session('admin.delete.error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Falha ao apagar o administrador',
                    timer: 3000
                })
            </script>
        @endif

        @if(session('admin.estado.success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Estado do administrador atualizado com sucesso',
                    timer: 3000
                })
            </script>
        @endif

        @if(session('admin.estado.error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Falha ao atualizar o estado do administrador',
                    timer: 3000
                })
            </script>
        @endif

        @if(session('admin.update.success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Informações do administrador atualizadas com sucesso',
                    timer: 3000
                })
            </script>
        @endif

        @if(session('admin.update.error'))
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
