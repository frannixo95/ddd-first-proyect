<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Infrastructure\Persistence\Doctrine\Entity;


final class Subtitle
{
    private string $id;
    private string $language;
    private Video $video;

    public function __construct(string $id, string $language)
    {
        $this->id = $id;
        $this->language = $language;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getVideo(): Video
    {
        return $this->video;
    }

    public function setVideo(Video $video): void
    {
        $this->video = $video;
    }


}