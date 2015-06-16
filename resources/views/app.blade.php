{{--
    Este é o template `master` que é extendido pelos templates.
--}}

<!DOCTYPE html>

{{--
    Declaramos HTML normal
--}}

<html lang="en" ng-app="FornApp">
    <head>
        <title>Extensão Feevale</title>

        {{--
            Links de CSS e javascript para bootstrap
        --}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand">HT Feevale</a>
                </div>
            </div>
        </nav>
        
        <div class="container">
            {{--
                Aqui mostramos os erros que o Laravel cria automaticamente
                na variável `$errors`
            --}}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{--
                Caso exista mensagens na sessão, mostramos
            --}}
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif

            {{--
                função `@yield` chama a extensão, quer dizer, em outras views
                extendemos esta da seguinte forma:
                ```
                @extends('app') //app é o nome do template master (este arquivo)

                @section('content') //nome do `yield`
                @stop //fim da sessão
            --}}
            @yield('content')
        </div>
    </body>
</html>