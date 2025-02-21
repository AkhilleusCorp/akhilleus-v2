<?php

namespace App\Infrastructure\ApiDoc;

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\RequestBody;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class PostParameters extends RequestBody
{
    public function __construct(string $dataClass)
    {
        parent::__construct(content: new Model(type: $dataClass));
    }
}
