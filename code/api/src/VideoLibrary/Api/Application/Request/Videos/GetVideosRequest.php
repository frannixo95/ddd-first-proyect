<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Application\Request\Videos;


final class GetVideosRequest
{
    private string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

}