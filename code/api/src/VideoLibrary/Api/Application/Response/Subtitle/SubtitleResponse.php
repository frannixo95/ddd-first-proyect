<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Application\Response\Subtitle;


use VideoLibrary\Api\Domain\Model\Subtitle\Subtitle;

final class SubtitleResponse
{

    private string $id;
    private string $language;

    public function __construct(Subtitle $subtitle)
    {
        $this->id = $subtitle->getId()->getValue();
        $this->language = $subtitle->getLang();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function toArray():array{
        return [
            'id' => $this->getId(),
            'language' => $this->getLanguage(),
        ];
    }

}