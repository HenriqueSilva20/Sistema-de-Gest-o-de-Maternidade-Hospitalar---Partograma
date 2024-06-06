@extends('Layouts.Admin.merge')

@section('conteudo')

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <div class="orders">
                    <div class="row">

                        @section('titulo', 'Professores | HakyOff')

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body mb-2 d-flex justify-content-between">
                                    <h4 class="box-title pt-2">Professores registrados </h4>
                                    <div>
                                        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#addProf"><i class="fa fa-edit"></i> Cadastrar Professor</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-stats order-table ov-h">
                                        <table id="bootstrap-data-table" class="mt-4 table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Foto</th>
                                                    <th>Nome</th>
                                                    <th>Formação</th>
                                                    <th>Data de cadastro</th>
                                                    <th>Operações</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($professores as $professor)
                                                <tr>
                                                    <td> #{{ $professor->id }} </td>
                                                    <td> <img src="/uploads/professores/fotos/{{ $professor->foto }}" style="width: 10vh; height: 8vh; object-fit: cover; border-radius: 50%" alt=""> </td>
                                                    <td>  <span class="name">{{ $professor->nome }}</span> </td>
                                                    <td> <span class="product">{{ $professor->formacao }}</span> </td>
                                                    <td><span class="date">{{ date('d-m-Y', strtotime($professor->created_at)) }}</span></td>
                                                    <td>
                                                        <a class="btn btn-danger" data-toggle="modal" data-target="#deleteProf{{ $professor->id }}"><i class="fa fa-trash text-white"></i></a>
                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#editProf{{ $professor->id }}"><i class="fa fa-eye text-white"></i></a>
                                                    </td>
                                                </tr>

                                                <!-- Modal - ADD LABVIRTUAL -->
                                                <div class="modal fade none-border" id="editProf{{ $professor->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title"><strong>Editando informções do professor</strong></h4>
                                                            </div>
                                                            <form method="POST" action="{{ route('professores.update', $professor->id) }}" enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-7 mb-4">
                                                                            <label class="control-label">Nome</label>
                                                                            <input class="form-control form-white" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" value="{{ $professor->nome }}" type="text" name="nome" id="nome"/>
                                                                        </div>
                                                                        <div class="col-md-5 mb-4">
                                                                            <label class="control-label">Email</label>
                                                                            <input class="form-control form-white" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" value="{{ $professor->email }}" type="email" name="email" id="email"/>
                                                                        </div>
                                                                        <div class="col-md-3 mb-4">
                                                                            <label class="control-label">Telefone</label>
                                                                            <input class="form-control form-white" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" value="{{ $professor->telefone }}" type="tel" name="telefone" id="telefone"/>
                                                                        </div>
                                                                        <div class="col-md-5 mb-4">
                                                                            <label class="control-label">Formação</label>
                                                                            <input class="form-control form-white" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" value="{{ $professor->formacao }}" type="text" name="formacao" id="formacao"/>
                                                                        </div>
                                                                        <div class="col-md-4 mb-4">
                                                                            <label class="control-label">País</label>
                                                                            <select class="form-control" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" form-white" data-placeholder="Selecione o país" name="pais" id="pais">
                                                                                <option value="{{ $professor->pais }}">{{ $professor->pais }}</option>
                                                                                <option value="Argélia">Argélia</option>
                                                                                <option value="Alemanha">Alemanha</option>
                                                                                <option value="Angola">Angola</option>
                                                                                <option value="Andora">Andora</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4 mb-4">
                                                                            <label class="control-label">Verificado?</label>
                                                                            <select class="form-control" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" form-white" data-placeholder="Professor é verificado?" name="verificado" id="verificado">
                                                                                <option value="1">Sim</option>
                                                                                <option value="0">Não</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12 mb-4">
                                                                            <label class="control-label">Foto de perfil</label>
                                                                            <input class="form-control form-white" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" placeholder="" type="file" name="foto" id="foto"/>
                                                                        </div>
                                                                        <!--div class="col-md-12 mb-4">
                                                                            <label class="control-label">Biografia (800)</label>
                                                                            <textarea name="biografia" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" class="form-control" id="biografia" cols="30" rows="5">{{ $professor->biografia }}</textarea>
                                                                        </div-->
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                                                                    <button type="submit" class="btn btn-danger waves-effect waves-light save-category"> <i class="fa fa-save"></i> Salva</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /#add-category -->

                                                <!-- Modal - Calendar - Add New Event -->
                                                <div class="modal fade none-border p-4" id="deleteProf{{ $professor->id }}">
                                                    <div class="modal-dialog modal-center">
                                                        <div class="modal-content">
                                                            <div class="modal-header p-4 d-flex justify-content-center align-items-center text-center">
                                                                <h4 class="modal-title"><strong>Pretende continuar e apagar o registro?</strong></h4>
                                                            </div>
                                                            <div class="modal-footer p-4 d-flex justify-content-center align-items-center">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                                                                <a href="{{ route('professores.delete', $professor->id) }}" class="btn btn-danger delete-event waves-effect waves-light">Apagar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /#event-modal -->


                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div> <!-- /.table-stats -->
                                </div>
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->

                    </div>
                </div>
                <!-- /.orders -->

                <!-- Modal - ADD LABVIRTUAL -->
                <div class="modal fade none-border" id="addProf">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Registrando um novo professor</strong></h4>
                            </div>
                            <form method="POST" action="{{ route('professores.cadastrar') }}" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-7 mb-4">
                                            <label class="control-label">Nome</label>
                                            <input class="form-control form-white" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" placeholder="" type="text" name="nome" id="nome"/>
                                        </div>
                                        <div class="col-md-5 mb-4">
                                            <label class="control-label">Email</label>
                                            <input class="form-control form-white" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" placeholder="" type="email" name="email" id="email"/>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label class="control-label">Telefone</label>
                                            <input class="form-control form-white" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" placeholder="" type="tel" name="telefone" id="telefone"/>
                                        </div>
                                        <div class="col-md-5 mb-4">
                                            <label class="control-label">Formação</label>
                                            <input class="form-control form-white" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" placeholder="" type="text" name="formacao" id="formacao"/>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label class="control-label">País</label>
                                            <select class="form-control" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" form-white" data-placeholder="Selecione o país" name="pais" id="pais">
                                                <option value="Argélia">Argélia</option>
                                                <option value="Alemanha">Alemanha</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Andora">Andora</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label class="control-label">Verificado?</label>
                                            <select class="form-control" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" form-white" data-placeholder="Professor é verificado?" name="verificado" id="verificado">
                                                <option value="1">Sim</option>
                                                <option value="0">Não</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label class="control-label">Foto de perfil</label>
                                            <input class="form-control form-white" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" placeholder="" type="file" name="foto" id="foto"/>
                                        </div>
                                        <!--div class="col-md-12 mb-4">
                                            <label class="control-label">Biografia (800)</label>
                                            <textarea name="biografia" style="border-radius: 0px !important; border: 1px solid #999; border-bottom: 3px solid #555" class="form-control" id="biografia" cols="30" rows="5"></textarea>
                                        </div-->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-danger waves-effect waves-light save-category"> <i class="fa fa-save"></i> Salva</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- /#add-category -->

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if(session('professores.create.success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Professor cadastrado com sucesso',
                    timer: 4500
                })
            </script>
        @endif

        @if(session('professores.create.error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Falha ao cadastrar o professor',
                    timer: 4500
                })
            </script>
        @endif

        @if(session('professores.update.success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Informações do professor atualizadas com sucesso',
                    timer: 4500
                })
            </script>
        @endif

        @if(session('professores.update.error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro Atualização',
                    text: 'Falha ao atualizar as informações do professor',
                    timer: 4500
                })
            </script>
        @endif

        @if(session('professores.delete.success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Registro apagado com sucesso',
                    timer: 4500
                })
            </script>
        @endif

        @if(session('professores.delete.error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro Delete',
                    text: 'Falha ao apagar o registro',
                    timer: 4500
                })
            </script>
        @endif

        @if(session('professores.foto.error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro Upload',
                    text: 'Falha ao carregar a foto do professor',
                    timer: 4500
                })
            </script>
        @endif

@endsection
