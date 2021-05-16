<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\ORMException;
use VideoLibrary\Api\Domain\Model\Subtitle\Subtitle;
use VideoLibrary\Api\Infrastructure\Persistence\Doctrine\Entity\Subtitle as SubtitleEntity;
use VideoLibrary\Api\Domain\Model\Videos\Status;
use VideoLibrary\Api\Domain\Model\Videos\Video;
use VideoLibrary\Api\Domain\Model\Videos\VideoCollection;
use VideoLibrary\Api\Domain\Model\Videos\VideoId;
use VideoLibrary\Api\Domain\Model\Videos\VideoRepository;
use VideoLibrary\Api\Infrastructure\Persistence\Doctrine\Entity\Video as VideoEntity;

final class DoctrineVideoRepository extends DoctrineRepository implements VideoRepository
{

    protected function entityClassName(): string
    {
        return VideoEntity::class;
    }
    public function findByStatus(Status $status): VideoCollection
    {
        $videos = $this->repository->findBy([
            'status'=> $status->getValue()
        ]);
        $videoCollection = VideoCollection::init();

        if(!empty($videos)){
            foreach ($videos as $video){
                $videoCollection->add($this->toDomain($video));
            }
        }
        return $videoCollection;
    }


    public function addVideo(Video $video): void
    {
        try {
            $this->entityManager->persist($this->toInfrastructure($video));
            $this->entityManager->flush();
        } catch (ORMException $e) {
        }

    }

    private function toInfrastructure(Video $video): VideoEntity{

        $videoEntity = new VideoEntity(
            $video->getId()->getValue(),
            $video->getTitle(),
            $video->getDuration(),
            $video->getStatus()->getValue(),
            new ArrayCollection(),
            $video->getCreatedAt(),
            $video->getUpdatedAt()

        );

        array_map(function($subtitle) use ($videoEntity){
            $videoEntity->addSubtitle($this->subtitleToInfrastructure($subtitle));
        },$video->getSubtitles()->getCollection());

        return $videoEntity;
    }

    private function subtitleToInfrastructure(Subtitle $subtitle):SubtitleEntity{
        return new SubtitleEntity(
            $subtitle->getId()->getValue(),
            $subtitle->getLang()
        );
    }

    private function toDomain(VideoEntity $video): Video{
        return new Video(
            new VideoId($video->getId()),
            $video->getTitle(),
            $video->getDuration(),
            new Status($video->getStatus())
        );
    }


}