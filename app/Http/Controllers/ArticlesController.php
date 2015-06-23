<?php

// LEIA OS COMENTÁRIOS :D

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use View;
use App\Tag;

/**
 * Nesse exemplo de controller, fazemos alguma operações de diferentes maneiras Lembre-se:
 * em desenvolvimento de software não existem leis, ou regras definitivas. Leve em
 * consideração o contexto e o que se sente mais confortável fazendo
 */

class ArticlesController extends Controller
{
    /**
     * Mostrando uma lista com os recursos
     *
     * @return View
     */
    public function index()
    {
        /**
         * Perceba que estamos instanciando uma nova `view` utilizando o método
         * `make`. Ela é criada e atributos que são passados para a mesma
         * são feitos através de atributos. Nesse caso, `articles`.
         */
        $view = View::make('index');
        $view->articles = Article::all();

        // Retornando view a ser mostrada no browser
        return $view;
    }

    /**
     * Mostrando um form para a criação do recurso
     *
     * @return View
     */
    public function create()
    {
        /**
         * Aqui retornamos a view utilizando uma função auxiliar. Ela vai fazer
         * o trabalho de instanciar a view e retornar. O parâmetro passado é
         * o nome da view, a partir da pasta `resources/views`
         */
        return view('create');
    }

    /**
     * Armazenando um recurso na base de dados
     *
     * @return Response
     */
    public function store(Request $request)
    {

        /**
         * Precisamos validar os dados vindo da nossa requisição. Para tal
         * usamos dependency injection para "injetar" um objeto 
         * Request e validarmos
         */
        $this->validate($request, [
            'title' => ['required'],
            'body'  => ['required']
        ], [
            'title.required' => 'Campo título é obrigatório',
            'body.required' => 'Campo corpo é obrigatório',
        ]);

        /**
         * Nesse método, instanciamos um novo artigo (`model`) e criamos atributos
         * correspondentes aos campos na tabela. Os dados são pegos através
         * da classe `Input`, método `get`.
         */
        $article = new Article;

        $article->title = Input::get('title');
        $article->body = Input::get('body');

        // Aqui persistimos o model na base de dados. A inserção será automaticamente criada
        $article->save();

        /**
         * Sincronizamos os artigos e tags, ou seja, os ids serão inseridos
         * se não existirem, ou removidos se não constarem no array
         * de $this->tags()
         */
        $article->tags()->sync($this->tags());

        /**
         * Por fim, retornamos um redirecionamento
         * onde passamos a URI com uma mensagem
         * para darmos feedback ao usuário.
         */
        return redirect('/artigos')->with('message', 'Artigo inserido com sucesso!');
    }

    /**
     * Mostrando um recurso específico
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        /**
         * Retornamos a view novamente, assim como em `create`, utilizando uma função
         * auxiliar. O parâmetro passado é, de novo a view, a partir da pasta
         * `resources/views`. Nesse caso, a view é `show.blade.php`
         */
        return view('show', [
            // Perceba que utilizamos o método `find`, passando o id para buscarmos o artigo
            'article' => Article::find($id)
        ]);
    }

    /**
     * Mostrando o form para editar um recurso específico
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        /**
         * Assim como no método show, para buscarmos um recurso específico,
         * utilizamos o método `find`. Esse método retorna um módel com
         * as informações específicas já preenchidas.
         */
        $article = Article::find($id);

        /**
         * Retornando a view edit.blade.php, passando um array com a seguinte estrutura:
         * `['article' => '$article']`. Para tanto, utilizamos a função do php
         * `compact` que deixa uma leitura mais limpa
         */
        return view('edit', compact('article'));
    }

    /**
     * Atualiza o recurso específico no banco de dados
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        /**
         * Precisamos validar os dados vindo da nossa requisição. Para tal
         * usamos dependency injection para "injetar" um objeto 
         * Request e validarmos
         */
        $this->validate($request, [
            'title' => ['required'],
            'body'  => ['required']
        ], [
            'title.required' => 'Campo título é obrigatório',
            'body.required' => 'Campo corpo é obrigatório',
        ]);


        // Buscamos o artigo, novamente com `find`
        $article = Article::find($id);

        /**
         * Utilizamos o método `fill` e passamos todas as infomações da requisição
         * para preencher o model. Perceba que alteramos apenas as diferentes
         * do model já buscado.  Os campos também devem constar no model
         * no array `$fillable`, por questões de segurança.
         */
        $article->fill($request->all());

        // Salvando o model
        $article->save();

        /**
         * Sincronizamos os artigos e tags, ou seja, os ids serão inseridos
         * se não existirem, ou removidos se não constarem no array
         * de $this->tags()
         */
        $article->tags()->sync($this->tags()); // Mesmo comando do método store


        /**
         * Por fim, retornamos um redirecionamento
         * onde passamos a URI com uma mensagem
         * para darmos feedback ao usuário.
         */
        return redirect('/artigos')->with('message', 'O artigo foi alterado com sucesso.');
    }

    /**
     * Removendo um recurso específico do banco de dados
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // Buscamos o recurso
        $article = Article::find($id);

        // Destruímos o mesmo
        $article->delete();

        /**
         * Por fim, retornamos um redirecionamento
         * onde passamos a URI com uma mensagem
         * para darmos feedback ao usuário.
         */
        return redirect('/artigos')
                ->with('message', 'O artigo foi excluído com sucesso.');
    }

    /**
     * Buscamos as tags que serão anexadas às pivot tables
     */
    private function tags()
    {
        $tags   = explode(';', Input::get('tags'));
        $tagsId = [];
        foreach ($tags as $tag) {
            // Normalizamos a tag
            $tag = trim($tag);

            /**
             * Testamos se as tags existem Se existirem
             * apenas adicionamos ao array Caso
             * contrário, criamos e adicionamos
             */
            $tagModel = Tag::where('tag', $tag)->first();

            if (is_null($tagModel)) {
                $tagModel = Tag::create(['tag' => $tag]);
            }
            
            array_push($tagsId, $tagModel->id);
        }

        return $tagsId;
    }
}
