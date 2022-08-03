<?php

namespace App\JsonApi\V1\Posts;

use App\Models\User;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'posts';

    /**
     * @param \App\Models\Post $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string)$resource->getRouteKey();
    }

    /**
     * @param \App\Models\Post $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'title' => $resource->title,
            'content' => $resource->content,
            'status' => $resource->status,
            'userId' => $resource->user_id,
            'createdAt' => $resource->created_at,
            'updateAt' => $resource->updated_at,
        ];
    }

    public function getRelationships($post, $isPrimary, array $includeRelationships)
    {
        return [
            'author' => [
                self::DATA => function () use ($post) {
                    $author = $post->author;
                    return $author;
                },
            ],
            'comments' => [
                self::SHOW_RELATED => true,
            ],
            'ratings' => [
                self::SHOW_RELATED => true,
                self::META => function () use ($post) {
                    return [
                        'avg' => $post->rateAvg,
                    ];
                },
            ],
        ];
    }
}
