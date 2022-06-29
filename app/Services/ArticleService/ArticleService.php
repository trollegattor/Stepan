<?php

namespace App\Services\ArticleService;


use App\Http\Requests\DestroyArticleRequest;
use App\Http\Requests\ShowArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class ArticleService
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Article::all();
    }

    /**
     * @param StoreArticleRequest $request
     * @return Article
     */
    public function create(StoreArticleRequest $request): Article
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ];

        /** @var Article $article */
        $article = Article::query()->create($data);

        return $article;
    }

    /**
     * @param UpdateArticleRequest $request
     * @return Article
     */
    public function update(UpdateArticleRequest $request): Article
    {
        $id = $request->route('article');
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ];
        /** @var Article $article */
        $article = Article::query()->find($id);
        $article->update($data);

        return $article;
    }

    /**
     * @param ShowArticleRequest $request
     * @return Article
     */
    public function show(ShowArticleRequest $request): Article
    {
        $id = $request->route('article');
        /** @var Article $article */
        $article = Article::query()->find($id);

        return $article;
    }

    /**
     * @param DestroyArticleRequest $request
     * @return bool
     */
    public function destroy(DestroyArticleRequest $request): bool
    {
        $id = $request->route('article');

        return Article::query()->where('id', $id)->delete();
    }

}
