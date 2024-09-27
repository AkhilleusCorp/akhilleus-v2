<?php

namespace App\Tests\units\Infrastructure\Tools;

use App\Infrastructure\Tools\CustomSerializer;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use stdClass;

final class CustomSerializerTest extends TestCase
{
    public function testWithNoDateFormatProvided(): void
    {
        $object = $this->getObject();
        $serializer = new CustomSerializer(null);

        $result = $serializer->normalize($object, null);

        $this->assertEquals($object->text, $result['text']);
        $this->assertEquals('01-26-2024 08:00:00', $result['date']);
    }

    public function testWithDateFormatProvided(): void
    {
        $object = $this->getObject();
        $serializer = new CustomSerializer('d/m/Y');

        $result = $serializer->normalize($this->getObject(), null);

        $this->assertEquals($object->text, $result['text']);
        $this->assertEquals('26/01/2024', $result['date']);
    }

    private function getObject(): stdClass
    {
        $object = new stdClass();
        $object->text = 'This is text';
        $object->date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2024-01-26 20:00:00');

        return $object;
    }
}