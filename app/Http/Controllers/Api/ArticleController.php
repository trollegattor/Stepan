<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;


class ArticleController extends Controller
{

    /**
     * @param ArticleService $articleService
     * @return AnonymousResourceCollection
     */
    public function index(ArticleService $articleService): AnonymousResourceCollection
    {
        $articles = $articleService->getAll();

        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request
     * @param ArticleService $articleService
     * @return ArticleResource
     */
    public function store(StoreArticleRequest $request, ArticleService $articleService): ArticleResource
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author' => $request->input('author'),
        ];
        $newArticle = $articleService->create($data);

        return new ArticleResource($newArticle);
    }

    /**
     * @param ShowArticleRequest $request
     * @param ArticleService $articleService
     * @return ArticleResource
     */
    public function show(ShowArticleRequest $request, ArticleService $articleService): ArticleResource
    {
        $id=$request->route('article');
        $model = $articleService->show($id);

        return new ArticleResource($model);
    }

    /**
     * @param UpdateArticleRequest $request
     * @param ArticleService $articleService
     * @return ArticleResource
     */
    public function update(UpdateArticleRequest $request, ArticleService $articleService): ArticleResource
    {
        $id=$request->route('article');
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author' => $request->input('author'),
        ];
        $updateArticle = $articleService->update($id, $data);

        return new ArticleResource($updateArticle);
    }

    /**
     * @param ShowArticleRequest $request
     * @param ArticleService $articleService
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(ShowArticleRequest $request, ArticleService $articleService): JsonResponse
    {
        $id=$request->route('article');

        return new JsonResponse($articleService->destroy($id));
    }
}
