<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Infrastructure\Persistence\InMemory\Repository;

use VideoLibrary\Api\Domain\Model\Videos\Status;
use VideoLibrary\Api\Domain\Model\Videos\Video;
use VideoLibrary\Api\Domain\Model\Videos\VideoCollection;
use VideoLibrary\Api\Domain\Model\Videos\VideoId;
use VideoLibrary\Api\Domain\Model\Videos\VideoRepository;

final class InMemoryVideoRepository implements VideoRepository
{
    private array $videos;
    public function __construct()
    {
        $this->videos[] = new Video(
            new VideoId('Prueba'),
            'Pruebas',
            154,
            new Status('pending')
        );
        $this->videos[] = new Video(
            new VideoId('Prueba1'),
            'Pruebas1',
            154,
            new Status('remove')
        );
        $this->videos[] = new Video(
            new VideoId('Prueba2'),
            'Pruebas2',
            154,
            new Status('published')
        );
    }

    public function findByStatus(Status $status): VideoCollection
    {
        $videoCollection = new VideoCollection();

        array_map(function ($video) use ($videoCollection,$status){
            if($video->getStatus()->equals($status)){
                $videoCollection->add($video);
            }
        },$this->videos);

        return $videoCollection;
    }

    public function addVideo(Video $video): void
    {
    }
}