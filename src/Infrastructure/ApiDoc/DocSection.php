<?php

namespace App\Infrastructure\ApiDoc;

use OpenApi\Attributes\Tag;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
final class DocSection extends Tag
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }
}
