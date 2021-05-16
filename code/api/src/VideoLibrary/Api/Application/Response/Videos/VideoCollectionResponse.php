<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Application\Response\Videos;


use VideoLibrary\Api\Domain\Model\Videos\VideoCollection;

final class VideoCollectionResponse
{

    private array $videos;

    public function __construct(VideoCollection $videoCollection)
    {
        $this->videos = [];
        foreach ($videoCollection->getCollection() as $video){
            $this->videos[] = new VideoResponse($video);
        }
    }

    public function getVideos(): array
    {
        return $this->videos;
    }

    public function toArray():array{
        return array_map(function(VideoResponse $video){
            return $video->toArray();
        },$this->getVideos());
    }
}