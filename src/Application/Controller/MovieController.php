<?php

namespace App\Application\Controller;

use App\Application\Command\Movie\MovieCreateCommand;
use App\Application\Command\Movie\MovieDeleteCommand;
use App\Domain\BoundedContext\Movie\Movie;
use App\Infrastructure\Exception\NotValidFormException;
use App\Infrastructure\Repository\MovieRepositoryPomm;
use App\Infrastructure\Representation\MovieRepresentation;
use App\Infrastructure\Utils\Utils;
use App\Infrastructure\Command\CommandBus;
use App\Infrastructure\Command\CommandType;
use Hateoas\Configuration\Route;
use Hateoas\Representation\CollectionRepresentation;
use Hateoas\Representation\Factory\PagerfantaFactory;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Pagerfanta\Adapter\FixedAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends RestController
{
    private $movieRepository;

    public function __construct(
        SerializerInterface $serializer,
        CommandBus $commandBus,
        MovieRepositoryPomm $movieRepository
    ) {
        parent::__construct($serializer, $commandBus);

        $this->movieRepository = $movieRepository;
    }

    /**
     * @SWG\Post(
     *     @SWG\Parameter(
     *         name="movie",
     *         in="body",
     *         description="Movie to create",
     *         required=true,
     *         @SWG\Schema(ref=@Model(type=App\Application\Command\Movie\MovieCreateCommand::class))
     *     ),
     *     @SWG\Response(
     *         response="201",
     *         description="Movie created"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Unexpected error",
     *         @SWG\Schema(ref=@Model(type=App\Infrastructure\Command\Error::class))
     *     ),
     *     summary="Creates a new movie in the dabase. Duplicates are allowed",
     *     tags={"Movie"}
     * )
     */
    public function create(Request $request): JsonResponse
    {
        $command = new MovieCreateCommand();

        $form = $this->createForm(CommandType::class, $command, ['data_class' => MovieCreateCommand::class]);
        $form->submit(Utils::camelizeArray(json_decode($request->getContent(), true)));

        if (!$form->isValid()) {
            throw new NotValidFormException($form);
        }

        return new JsonResponse($this->commandBus->handle($command), JsonResponse::HTTP_CREATED);
    }

    /**
     * @SWG\Delete(
     *     @SWG\Parameter(
     *         description="ID of movie to fetch",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="Movie deleted"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Unexpected error",
     *         @SWG\Schema(ref=@Model(type=App\Infrastructure\Command\Error::class))
     *     ),
     *     summary="Deletes a single movie based on the ID supplied",
     *     tags={"Movie"}
     * )
     *
     * @ParamConverter("movie", converter="movie")
     */
    public function delete(Movie $movie): JsonResponse
    {
        $command = new MovieDeleteCommand();
        $command->id = $movie->id();

        return new JsonResponse($this->commandBus->handle($command), JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @SWG\Get(
     *     @SWG\Parameter(
     *         name="page",
     *         in="query",
     *         type="integer",
     *         description="The page number"
     *     ),
     *     @SWG\Parameter(
     *         name="limit",
     *         in="query",
     *         type="integer",
     *         description="Maximum number of results to return"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="List of the movies",
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Unexpected error",
     *         @SWG\Schema(ref=@Model(type=App\Infrastructure\Command\Error::class))
     *     ),
     *     summary="Returns all movies from the system that the user has access to",
     *     tags={"Movie"}
     * )
     */
    public function list(Request $request): JsonResponse
    {
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 10);

        $movieRepresentations = [];

        foreach ($this->movieRepository->list($page, $limit) as $dMovie) {
            $movieRepresentations[] = new MovieRepresentation($dMovie);
        }

        $pager = new Pagerfanta(new FixedAdapter(count($movieRepresentations), $movieRepresentations));
        $pager->setMaxPerPage($limit);

        $paginatedCollection = (new PagerfantaFactory())->createRepresentation(
            $pager,
            new Route($request->get('_route'), array_merge(
                    $request->get('_route_params'),
                    $request->query->all())
            ),
            new CollectionRepresentation($pager->getCurrentPageResults())
        );

        return new JsonResponse(
            $this->serializer->serialize(
                $paginatedCollection,
                'json',
                SerializationContext::create()->setGroups(['Default', 'movie_list'])->setSerializeNull(true)
            ),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @SWG\Get(
     *     @SWG\Parameter(
     *         description="ID of movie to fetch",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Movie response",
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Unexpected error",
     *         @SWG\Schema(ref=@Model(type=App\Infrastructure\Command\Error::class))
     *     ),
     *     summary="Returns a user based on a single ID, if the user does not have access to the movie",
     *     tags={"Movie"}
     * )
     *
     * @ParamConverter("movie", converter="movie")
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
