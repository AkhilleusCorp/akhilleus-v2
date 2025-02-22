<?php

namespace App\Infrastructure\ApiDoc;

use OpenApi\Attributes\Response;

#[\Attribute(\Attribute::TARGET_METHOD)]
final class NotFoundResponse extends Response
{
    public function __construct(string $description)
    {
        parent::__construct(
            response: 404,
            description: $description
        );
    }
}
