<?php

namespace App\Http\Controllers\Api\V1\Ratings;

use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use CloudCreativity\LaravelJsonApi\Http\Requests\CreateResource;
use CloudCreativity\LaravelJsonApi\Http\Requests\DeleteResource;
use CloudCreativity\LaravelJsonApi\Http\Requests\FetchResources;
use CloudCreativity\LaravelJsonApi\Http\Requests\UpdateResource;

class RatingsController extends JsonApiController
{

    public function searching(FetchResource $request)
    {

    }
    public function searched($results, FetchResource $request)
    {

    }
    public function creating( CreateResource $request)
    {

    }
    public function updating($record, UpdateResource $request)
    {

    }
    public function saving($record,  $request)
    {

    }
    public function deleting($record, DeleteResource $request)
    {

    }
}
