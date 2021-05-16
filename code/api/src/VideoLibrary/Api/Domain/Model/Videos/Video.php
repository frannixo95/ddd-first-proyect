<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Domain\Model\Videos;


use DateTime;
use DateTimeImmutable;

final class Video
{
    private VideoId $id;
    private string $title;
    private int $duration;
    private Status $status;
    private DateTimeImmutable $createdAt;
    private DateTime $updatedAt;
    private SubtitleCollection $subtitles;

    public function __construct(VideoId $id, string $title, int $duration, Status $status, SubtitleCollection $subtitles)
    {
        $this->id = $id;
        $this->title = $title;
        $this->duration = $duration;
        $this->status = $status;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTime();
        $this->subtitles = $subtitles;
    }


    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
    public function getId(): VideoId
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
    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getSubtitles(): SubtitleCollection
    {
        return $this->subtitles;
    }



}