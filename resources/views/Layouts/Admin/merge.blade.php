<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('titulo')</title>

    @include('Layouts.Admin.head');

</head>

<body id="page-top">

    <style type="text/css">
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Fundo preto semi-transparente */
            display: none;
            /* Ocultar por padrão */
            z-index: 9999;
            /* Certificar-se de que está sobre todos os elementos */
        }

        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 4px solid #f3f3f3;
            /* Cinza claro para os espaços entre as bolinhas */
            border-top: 4px solid #3498db;
            /* Azul para a bolinha em si */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            /* Animação de rotação */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <div id="wrapper">

        @if (Auth::user()->acesso == 0)
            <?php Auth::logout(); ?>
        @endif

        @include('Layouts.Admin.aside')

        @include('Layouts.Admin.menu')

        @yield('conteudo')

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        @include('Layouts.Admin.rodape')

        <script type="text/javascript">
            document.getElementById('formulario').addEventListener('submit', function() {
                // Mostrar o overlay de loading quando o formulário for enviado
                document.getElementById('loading-overlay').style.display = 'block';
            });
        </script>

</body>

</html>
