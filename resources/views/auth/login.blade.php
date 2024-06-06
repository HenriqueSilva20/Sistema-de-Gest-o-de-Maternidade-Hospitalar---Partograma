@extends('layouts.app')
@section('titulo', 'Iniciar sessão no painel de gestão')
@section('content')

    <div class="container-login">
        <div class="row justify-content-center mt-4 pt-4">
            <div class="col-xl-4 col-lg-12 col-md-9 mt-4 pt-4">
                <div class="card shadow-sm my-5 mt-4">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4" style="font-size: 3rem">SGMH</h1>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" id="login" class="user">
                                        @csrf
                                        <div class="form-group">
                                            @error('email')
                                                <span
                                                    style="width: 100%; background: none !important;  margin-bottom: -75px !important">
                                                    <strong style="color: red; font-size: .8rem !important">Email ou senha
                                                        inválidos</strong>
                                                </span>
                                            @enderror
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            @error('password')
                                                <span
                                                    style="width: 100%; background: none !important;  margin-bottom: -75px !important">
                                                    <strong style="color: red; font-size: .8rem !important">Senha
                                                        inválidos</strong>
                                                </span>
                                            @enderror
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                name="password" placeholder="Senha">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                                <input type="checkbox" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }} class="custom-control-input">
                                                <label class="custom-control-label" for="remember">Lembre de mim</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">ENTRAR</button>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('login.exced.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Bloqueado',
                text: 'Você excedeu as tentativas de login. Volte a tentar novamente depois de 3 horas!',
                timer: 6000
            })
        </script>
    @endif

@endsection
