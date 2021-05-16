<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Application\Response\Subtitle;


use VideoLibrary\Api\Domain\Model\Videos\SubtitleCollection;

final class SubtitleCollectionResponse
{
    private array $subtitle;

    public function __construct(SubtitleCollection $subtitleCollection)
    {
        $this->subtitle = [];
        array_map(function($subtitle){
            $this->subtitle[] = new SubtitleResponse($subtitle);
        },$subtitleCollection->getCollection());
    }

    public function getSubtitle(): array
    {
        return $this->subtitle;
    }

    public function toArray(): array
    {
       return array_map(function(SubtitleResponse $subtitle){
           return $subtitle->toArray();
       },$this->getSubtitle());
    }
}