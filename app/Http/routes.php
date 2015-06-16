<?php

/**
 * Abaixo são as rotas da aplicação. Todas as rotas ficam no arquivo `routes.php` e na
 * classe responsável por gerenciar essas entradas é a `Route`. Nos exemplos abaixo,
 * você pode verificar que utilizamos a estrutura `Rota`::`metodo HTTP`
 */

/**
 * Também perceba que o segundo parâmetro corresponde ao método utilzado no
 * Controller. Dessa forma, a estrutura final, como pode ser vista, é:
 * metodo('url/com/quantos/segmentos/quiser', 'Controller@metodo')
 */

// Método onde os recursos (no nosso caso, artigos) são buscados e mostrados em uma tabela
Route::get('artigos', 'ArticlesController@index');

// Método que retorna uma view com o form para criação
Route::get('artigos/criar', 'ArticlesController@create');

// Método que mostra um form para edição do recurso
Route::get('artigos/{id}/edit', 'ArticlesController@edit');

// Método que busca e retorna uma view com o recurso
Route::get('artigos/{id}', 'ArticlesController@show');

// Método para armazenagem do recurso no banco de dados
Route::post('artigos', 'ArticlesController@store');

// Método para atualização do registro no banco de dados
Route::put('artigos/{id}', 'ArticlesController@update');

// Método para exclusão
Route::delete('artigos/{id}', 'ArticlesController@destroy');

