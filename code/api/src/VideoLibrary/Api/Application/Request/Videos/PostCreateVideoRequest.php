<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Application\Request\Videos;


final class PostCreateVideoRequest
{

    private string $title;
    private int $duration;
    private string $status;
    private array $subtitles;

    public function __construct(string $title, int $duration, string $status, array $subtitles)
    {
        $this->title = $title;
        $this->duration = $duration;
        $this->status = $status;
        $this->subtitles = $subtitles;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSubtitles(): array
    {
        return $this->subtitles;
    }


}