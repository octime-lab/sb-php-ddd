<?php

namespace App\Application\Controller;

use App\Domain\Entity\Movie;
use App\Infrastructure\Representation\MovieRepresentation;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;

class MovieController extends RestController
{
    /**
     * @SWG\Tag(name="Movie")
     * @SWG\Response(
     *     response=200,
     *     description="Returns the data of a movie",
     * )
     *
     * @ParamConverter("movie", converter="movie")
     *
     * @param Movie $movie
     *
     * @return JsonResponse
     */
    public function read(Movie $movie): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->serialize(
                new MovieRepresentation($movie),
                'json',
                SerializationContext::create()->setGroups(['movie_read'])->setSerializeNull(true)
            ),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }
}
