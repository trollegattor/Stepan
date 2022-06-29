<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyArticleRequest;
use App\Http\Requests\ShowArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleResourceCollection;
use App\Models\User;
use App\Services\ArticleService\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;


class ArticleController extends Controller
{
    /** @var ArticleService $articleService */
    public ArticleService $articleService;

    /**
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * @return ArticleResourceCollection
     */
    public function index(): ArticleResourceCollection
    {
        $showAll = $this->articleService->getAll();

        return new ArticleResourceCollection($showAll);
    }

    /**
     * @param StoreArticleRequest $request
     * @return ArticleResource
     */
    public function store(StoreArticleRequest $request): ArticleResource
    {
        $create = $this->articleService->create($request);

        return new ArticleResource($create);
    }

    /**
     * @param ShowArticleRequest $request
     * @return ArticleResource
     */
    public function show(ShowArticleRequest $request): ArticleResource
    {
        $show = $this->articleService->show($request);

        return new ArticleResource($show);
    }

    /**
     * @param UpdateArticleRequest $request
     * @return ArticleResource
     */
    public function update(UpdateArticleRequest $request): ArticleResource
    {
        $update = $this->articleService->update($request);

        return new ArticleResource($update);
    }

    /**
     * @param DestroyArticleRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyArticleRequest $request): JsonResponse
    {
        $delete=$this->articleService->destroy($request);

        return new JsonResponse($delete);
    }
}
