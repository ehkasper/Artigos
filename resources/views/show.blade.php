{{-- Exibimos um artigo --}}
@extends('app')

@section('content')
<div class="container container-fluid">

    <h1>{{ $article->title }}</h1>
    
    <p>
        {!! nl2br($article->body) !!}
    </p>

    <a href="/artigos" class="pull-right btn btn-default">Voltar</a>

</div>

@stop
