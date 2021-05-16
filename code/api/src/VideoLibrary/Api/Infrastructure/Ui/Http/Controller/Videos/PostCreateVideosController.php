<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Infrastructure\Ui\Http\Controller\Videos;


use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use VideoLibrary\Api\Application\Command\Videos\PostCreateVideoHandler;
use VideoLibrary\Api\Application\Request\Videos\PostCreateVideoRequest;
use VideoLibrary\Api\Domain\Model\Videos\InvalidStatusValueException;

final class PostCreateVideosController
{
    private PostCreateVideoHandler $postCreateVideoHandler;

    public function __construct(PostCreateVideoHandler $postCreateVideoHandler)
    {
        $this->postCreateVideoHandler = $postCreateVideoHandler;
    }

    public function __invoke(Request $request)
    {
        try {
            $video = ($this->postCreateVideoHandler)(new PostCreateVideoRequest(
                $request->get('title'),
                (int) $request->get('duration',0),
                $request->get('status'),
                $request->get('subtitles')
            ));
            $response = new JsonResponse([
                'status'=> 'ok',
                'hits'=> [
                    $video->toArray()
                ]
            ]);

        }catch (Exception $e){
            $response = new JsonResponse([
                'status'=> 'error',
                'message'=> $e->getMessage()
            ],500);
        }

        return $response;

    }



}