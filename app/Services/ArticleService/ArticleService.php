<?php

namespace App\Services\ArticleService;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
     * @param $id
     * @param $data
     * @return int
     */
    public function update(int $id, array $data): int
    {
        return Article::query()->find('id',$id)->update($data);
    }

    /**
     * @param int $id
     * @return Article
     */
    public function show(int $id): Article
    {
        /** @var Article $article */
        $article=Article::query()->findOrFail($id);

        return $article;
    }

    /**
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function destroy(int $id): bool
    {
        return Article::query()->find('id',$id)->find($id);
    }

}
