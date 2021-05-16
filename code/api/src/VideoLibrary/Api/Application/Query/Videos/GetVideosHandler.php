<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Application\Query\Videos;


use VideoLibrary\Api\Application\Request\Videos\GetVideosRequest;
use VideoLibrary\Api\Application\Response\Videos\VideoCollectionResponse;
use VideoLibrary\Api\Domain\Model\Videos\Status;
use VideoLibrary\Api\Domain\Model\Videos\VideoRepository;

final class GetVideosHandler
{

private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function __invoke(GetVideosRequest $getVideosRequest): VideoCollectionResponse
    {
        $videos = $this->videoRepository->findByStatus(
            new Status(
                $getVideosRequest->getStatus()
            )
        );

        return new VideoCollectionResponse($videos);

    }

}