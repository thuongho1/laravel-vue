<?php

namespace App\Http\Controllers\Api\V1\Content\Posts;

use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use CloudCreativity\LaravelJsonApi\Contracts\Store\StoreInterface;
use CloudCreativity\LaravelJsonApi\Document\Error\Error;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use CloudCreativity\LaravelJsonApi\Http\Requests\CreateResource;
use CloudCreativity\LaravelJsonApi\Http\Requests\FetchResource;
use CloudCreativity\LaravelJsonApi\Http\Requests\FetchResources;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends JsonApiController
{

    /**
     * Index action.
     *
     * @param StoreInterface $store
     * @param FetchResources $request
     * @return Response
     */
    public function index(StoreInterface $store, FetchResources $request)
    {
        $result = $this->doSearch($store, $request);

        if ($this->isResponse($result)) {
            return $result;
        }

        return $this->reply()->content($result);
    }

    /**
     * Read resource action.
     *
     * @param StoreInterface $store
     * @param FetchResource $request
     * @return Response
     */
    public function read(StoreInterface $store, FetchResource $request)
    {
        $result = $this->doRead($store, $request);

        if ($this->isResponse($result)) {
            return $result;
        }

        return $this->reply()->content($result);
    }

    /**
     * Create resource action.
     *
     * @param StoreInterface $store
     * @param CreateResource $request
     * @return Response
     */
    public function create(StoreInterface $store, CreateResource $request)
    {
        $record = $this->transaction(function () use ($store, $request) {
            return $this->doCreate($store, $request);
        });

        if ($this->isResponse($record)) {
            return $record;
        }

        return $this->reply()->created($record);
    }


}
