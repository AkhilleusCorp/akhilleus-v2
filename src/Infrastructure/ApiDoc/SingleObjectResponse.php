<?php

namespace App\Infrastructure\ApiDoc;

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;

#[\Attribute(\Attribute::TARGET_METHOD)]
final class SingleObjectResponse extends Response
{
    public function __construct(
        int $response,
        string $description,
        string $dataClass,
    ) {
        $content = new JsonContent(
            properties: [
                new Property(property: 'data', ref: new Model(type: $dataClass)),
            ],
        );

        parent::__construct(
            response: $response,
            description: $description,
            content: $content
        );
    }
}
