<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Infrastructure\Service;


use Ramsey\Uuid\Uuid;
use VideoLibrary\Api\Domain\Service\IdStringGenerator;

final class UuidIdStringGenerator implements IdStringGenerator
{

    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}