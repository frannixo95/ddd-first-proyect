<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Domain\Model\Subtitle;


use VideoLibrary\Api\Domain\Model\Videos\Video;

final class Subtitle
{

    private SubtitleId $id;
    private string $lang;
    private Video $video;



    public function __construct(SubtitleId $id, string $lang)
    {
        $this->id = $id;
        $this->lang = $lang;
    }

    public function getId(): SubtitleId
    {
        return $this->id;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getVideo(): Video
    {
        return $this->video;
    }

}