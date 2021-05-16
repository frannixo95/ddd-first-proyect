<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Application\Response\Videos;

use VideoLibrary\Api\Application\Response\Subtitle\SubtitleCollectionResponse;
use VideoLibrary\Api\Domain\Model\Videos\Video;

final class VideoResponse
{
    private string $id;
    private string $title;
    private int $duration;
    private string $status;
    private SubtitleCollectionResponse $subtitles;


    public function __construct(Video $video)
    {
        $this->id = $video->getId()->getValue();
        $this->title = $video->getTitle();
        $this->duration = $video->getDuration();
        $this->status = $video->getStatus()->getValue();
        $this->subtitles = new SubtitleCollectionResponse($video->getSubtitles());

    }

    public function getId():string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getStatus():string
    {
        return $this->status;
    }

    public function getSubtitles(): SubtitleCollectionResponse
    {
        return $this->subtitles;
    }

    public function toArray():array{
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'duration' => $this->getDuration(),
            'status' => $this->getStatus(),
            'subtitles'=> $this->getSubtitles()->toArray()
        ];
    }
}