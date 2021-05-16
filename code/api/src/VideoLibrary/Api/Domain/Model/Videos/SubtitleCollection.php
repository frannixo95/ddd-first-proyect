<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Domain\Model\Videos;


use VideoLibrary\Api\Domain\Collection\ObjectCollection;
use VideoLibrary\Api\Domain\Model\Subtitle\Subtitle;

final class SubtitleCollection extends ObjectCollection
{

    protected function className(): string
    {
        return Subtitle::class;
    }
}