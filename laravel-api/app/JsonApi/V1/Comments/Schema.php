<?php

namespace App\JsonApi\V1\Comments;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'comments';

    /**
     * @param \App\Models\Comment $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Models\Comment $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'createdAt' => $resource->created_at,
            'updatedAt' => $resource->updated_at,
        ];
    }

    public function getRelationships($comment, $isPrimary, array $includeRelationships)
    {
        return [
            'post' => [
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includeRelationships['post']),
                self::DATA => function () use ($comment) {
                    return $comment->post;
                },
            ],
            'author' => [
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includeRelationships['author']),
                self::DATA => function () use ($comment) {
                    return $comment->author;
                },
            ],
        ];
    }
}
