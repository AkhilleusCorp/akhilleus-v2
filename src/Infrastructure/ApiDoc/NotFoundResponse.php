<?php

namespace App\Infrastructure\ApiDoc;

use OpenApi\Attributes\Response;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
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
