<?php

namespace App\Http\Controllers\Api\V1\Posts;

use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use CloudCreativity\LaravelJsonApi\Http\Requests\CreateResource;
use CloudCreativity\LaravelJsonApi\Http\Requests\DeleteResource;
use CloudCreativity\LaravelJsonApi\Http\Requests\FetchResources;
use CloudCreativity\LaravelJsonApi\Http\Requests\UpdateResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends JsonApiController
{

    public function searching($resource)
    {
//        $all = $resource->all();
//        /** @var Request $request*/
//        $request = $resource->getRequest();
//        dd($request);
//
//        $input = $request->json()->all();


    }

    public function searched($results, FetchResources $resource)
    {

        $items = $results->all();
        foreach ($items as $item) {
            $item->rateAvg = $this->getRateAvg($item);
        }

    }

    protected function getRateAvg($post)
    {
        return DB::table('ratings')
            ->where('post_id', $post->id)
            ->avg('rate');
    }

    public function creating(CreateResource $resource)
    {

    }

    public function updating($record, UpdateResource $resource)
    {

    }
    /**
     * @param $record
     * @param CreateResource|UpdateResource $resource
     */
    public function saving($record, $resource)
    {
        $all = $resource->all();
        if($all){
            $request_data = $all['data'];
        }
//        $resource->getRecord();
//        $record->user_id = $resource->user_id;
//        dd($record, $resource);
//        $request->


    }

    public function deleting($record, DeleteResource $resource)
    {

    }
}
