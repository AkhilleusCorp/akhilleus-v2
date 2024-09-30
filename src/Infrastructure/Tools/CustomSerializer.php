<?php

namespace App\Infrastructure\Tools;

use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class CustomSerializer
{
    private const DEFAULT_DATETIME_FORMAT = 'm-d-Y h:i:s A';
    private Serializer $serializer;

    public function __construct(
        ?string $dateTimeFormat
    ) {
        if (null === $dateTimeFormat) {
            $dateTimeFormat = self::DEFAULT_DATETIME_FORMAT;
        }

        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $objectNormalizer = new ObjectNormalizer($classMetadataFactory);
        $dateTimeNormalizer = new DateTimeNormalizer(
            [DateTimeNormalizer::FORMAT_KEY => $dateTimeFormat, DateTimeNormalizer::TIMEZONE_KEY => 'Europe/Paris']
        );
        $this->serializer = new Serializer([$dateTimeNormalizer, $objectNormalizer]);

    }
    public function normalize(mixed $data, ?string $serializationGroup): array
    {
        return $this->serializer->normalize($data, null, [$serializationGroup]);
    }
}