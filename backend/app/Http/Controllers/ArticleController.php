<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\ArticleCollection;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:article.index');
        $this->middleware('permission:article.store', ['only' => ['store']]);
        $this->middleware('permission:article.update', ['only' => ['update']]);
        $this->middleware('permission:article.destroy', ['only' => ['destroy']]);
        $this->middleware('permission:article.publish', ['only' => ['publish']]);
        $this->middleware('permission:article.unpublish', ['only' => ['unpublish']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new ArticleCollection(Article::with('user')->paginate());
        return response()->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return response()->success($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return response()->success($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        return response()->success($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->success(null);
    }

    /**
     * Notes:
     * Author: BillyShen likeboat@163.com
     * Time: 2020/3/5 9:44 下午
     * @param Request $request
     * @return mixed
     */
    public function publish(Request $request)
    {
        $article = Article::findorfail($request->article_id);
        $article->status = 1;
        $article->save();
        return response()->success($article);
    }

    /**
     * Notes:
     * Author: BillyShen likeboat@163.com
     * Time: 2020/3/5 9:44 下午
     * @param Request $request
     * @return mixed
     */
    public function unpublish(Request $request)
    {
        $article = Article::findorfail($request->article_id);
        $article->status = 0;
        $article->save();
        return response()->success($article);
    }
}
