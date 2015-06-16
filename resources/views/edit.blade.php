@extends('app')

@section('content')
    <div class="content">
        <form action="/artigos/{{ $article->id }}" method="post">
            {{--
                Como HTTP 1.1 não aceita outros métodos senão `GET` e `POST`,
                precisamos "emulá-los" através de inputs escondidos
            --}}
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group">
                <label for="title">Título</label>

                {{--
                    Objeto `$article` é passado do controller
                    (ex: quando um erro de validação acontecer e precisamos
                    voltar com campos preenchidos)
                --}}

                <input type="text" name="title" value="{{ $article->title }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="body">Corpo</label>
                <textarea name="body" id="body" class="form-control" rows="10">{{ $article->body }}</textarea>
            </div>

            <button class="btn btn-default btn-primary">Enviar</button>
        </form>

        {{-- Botão para exclusão, onde submetemos um form com o método `delete` --}}
        <form action="/artigos/{{ $article->id }}" method="post">
            <input type="hidden" name="_method" value="delete">
    
            {{-- Botão para exclusão, onde submetemos um form com o método `delete` --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <br><br>
            <button class="btn btn-danger">Excluir</button>
        </form>
    </div>
@stop