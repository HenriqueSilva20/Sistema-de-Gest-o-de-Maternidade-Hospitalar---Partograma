@extends('layouts.app')
@section('titulo', 'Recuperar acesso à conta')

@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form  class="login100-form validate-form"  method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <span class="login100-form-title p-b-26">
                            <img src="/icone2.png" style="width: 100px; margin-top: -34px" alt="">
                            <h5 style="margin-top: 15px; font-weight: 450 !important; font-size: .9rem">Recuperando acesso</h5>
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Email válido é: a@b.c">
                            <input id="email" type="email" placeholder="Email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="focus" data-placeholder="Email"></span>
                        </div>

                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button type="submit"  style="background: #ffc600 !important"  class="login100-form-btn">
                                    Enviar link de recuperação
                                </button>
                            </div>
                        </div>
                        <div class="text-center p-t-30">
                            <span class="txt1">
                                Lembrou da senha?
                            </span>

                            <a href="{{ route('login') }}" class="txt2" style="cursor: pointer" id="recuperarBtn">
                                Clique aqui
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
