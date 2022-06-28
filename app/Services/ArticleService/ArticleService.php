<?php

namespace App\Services\ArticleService;

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
     * @param $data
     * @return Article
     */
    public function create(array $data): Article
    {
        /** @var Article $article */
        $article=Article::query()->create($data);

        return $article;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Article
     */
    public function update(int $id, array $data): Article
    {
        /** @var Article $article */
        $article=Article::query()->find($id);
        $article->update($data);

        return $article;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function show(int $id): Article
    {
        /** @var Article $article */
        $article=Article::query()->find($id);

        return $article;
    }

    /**
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function destroy(int $id): bool
    {
        return Article::query()->where('id',$id)->delete();
    }

}
