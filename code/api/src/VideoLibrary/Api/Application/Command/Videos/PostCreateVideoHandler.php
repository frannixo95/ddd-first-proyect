<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Application\Command\Videos;

use VideoLibrary\Api\Application\Request\Videos\PostCreateVideoRequest;
use VideoLibrary\Api\Application\Response\Videos\VideoResponse;
use VideoLibrary\Api\Domain\Model\Subtitle\Subtitle;
use VideoLibrary\Api\Domain\Model\Subtitle\SubtitleId;
use VideoLibrary\Api\Domain\Model\Videos\Status;
use VideoLibrary\Api\Domain\Model\Videos\SubtitleCollection;
use VideoLibrary\Api\Domain\Model\Videos\Video;
use VideoLibrary\Api\Domain\Model\Videos\VideoId;
use VideoLibrary\Api\Domain\Model\Videos\VideoRepository;
use VideoLibrary\Api\Domain\Service\IdStringGenerator;

final class PostCreateVideoHandler
{

    private VideoRepository $videoRepository;
    private IdStringGenerator $idStringGenerator;


    public function __construct(VideoRepository $videoRepository, IdStringGenerator $idStringGenerator)
    {
        $this->videoRepository = $videoRepository;
        $this->idStringGenerator = $idStringGenerator;
    }

    public function __invoke(PostCreateVideoRequest $postCreateVideoRequest):VideoResponse
    {
        $video = new Video(
            new VideoId($this->idStringGenerator->generate()),
            $postCreateVideoRequest->getTitle(),
            $postCreateVideoRequest->getDuration(),
            new Status($postCreateVideoRequest->getStatus()),
            $this->buildSubtitleCollection($postCreateVideoRequest->getSubtitles())
        );
        $this->videoRepository->addVideo(
            $video
        );

        return new VideoResponse($video);

    }

    private function buildSubtitleCollection(array $subtitles):SubtitleCollection{

        $subtitleCollection = SubtitleCollection::init();
        if(!empty($subtitles)){
            array_map(function($subtitle) use ($subtitleCollection){
                    $subtitleCollection->add(
                        new Subtitle(
                            new SubtitleId($this->idStringGenerator->generate()),
                            $subtitle
                        )
                    );
            },$subtitles);
        }

        return $subtitleCollection;

    }

}