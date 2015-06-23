@extends('app')

@section('content')
    <div class="content">
        <form action="/artigos" method="post">
            {{-- Token para segurança --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group">
                <label for="title">Título</label>

                {{--
                    Função `old` retorna valores salvos na sessão
                    (ex: quando um erro de validação acontecer e precisamos
                    voltar com campos preenchidos)
                --}}
                <input type="text" name="title" value="{{ old('title') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="body">Corpo</label>
                <textarea name="body" id="body" class="form-control" rows="10">{{ old('body') }}</textarea>
            </div>

            <div class="form-group">
                <label for="tags">Tags (separe por ponto e vírgula)</label>
                <input type="text" name="tags" value="{{ old('tags') }}" class="form-control">
            </div>

            <button class="btn btn-default btn-primary">Enviar</button>
        </form>
    </div>
@stop