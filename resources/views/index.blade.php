{{--
	Extendemos a view
--}}
@extends('app')

<style>
	body {
		background: #000;
	}
</style>

{{--
	Criamos a sessão a ser "yieldada" no template master, no nosso caso, é o `app.blade.php`
--}}
@section('content')
<div class="container container-fluid">

	<h1>Meus Artigos</h1>
	
	<a href="/artigos/criar" class="pull-right btn btn-default">Novo Artigo</a>

	<br>

	<table class="table">
		@foreach ($articles as $article)
		<tr>
			<td>{{ $article->title }}</td>
			<td>
				<a href="/artigos/{{ $article->id }}/edit">Editar</a>
				<a href="/artigos/{{ $article->id }}">Visualizar</a>
			</td>
		</tr>
		@endforeach
	</table>

</div>

@stop
