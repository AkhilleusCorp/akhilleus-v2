<?php

namespace App\Infrastructure\ApiDoc;

use App\Infrastructure\View\ViewModel\PaginationViewModel;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;

#[\Attribute(\Attribute::TARGET_METHOD)]
final class MultipleObjectResponse extends Response
{
    public function __construct(
        int $response,
        string $description,
        string $dataClass,
    ) {
        $content = new JsonContent(
            properties: [
                new Property(property: 'data', type: 'array', items: new Items(ref: new Model(type: $dataClass))),
                new Property(property: 'extra', properties: [
                    new Property(property: 'pagination', ref: new Model(type: PaginationViewModel::class)),
                ]),
            ],
        );

        parent::__construct(
            response: $response,
            description: $description,
            content: $content
        );
    }
}
