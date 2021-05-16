<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Domain\Model\Videos;


use VideoLibrary\Api\Domain\Collection\ObjectCollection;

final class VideoCollection extends ObjectCollection
{

    protected function className(): string
    {
        return Video::class;
    }

    public static function init(): self
    {
        return new static([]);
    }
}