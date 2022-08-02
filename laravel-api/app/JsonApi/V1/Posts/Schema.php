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
            'author_id' => $resource->author_id,
            'created_at' => $resource->created_at,
            'update_at' => $resource->updated_at,
        ];
    }

    public function getRelationships($post, $isPrimary, array $includeRelationships)
    {
        return [
            'author' => [
                self::DATA => function () use ($post) {
//            $user = User::load([$post->author]);
                    $author = $post->author;
                    return $author;
                },
            ],
            'comments' => [
                self::SHOW_RELATED => true,
            ],
        ];
    }
}
