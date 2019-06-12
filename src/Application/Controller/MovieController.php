<?php

namespace App\Application\Controller;

use App\Application\Form\Command\Movie\MovieCreateCommand;
use App\Application\Type\CommandType;
use App\Domain\BoundedContext\Movie\Entity\Movie;
use App\Application\Command\CommandBus;
use App\Infrastructure\Exception\NotValidFormException;
use App\Infrastructure\Repository\MovieRepository;
use App\Infrastructure\Representation\MovieRepresentation;
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
    /**
     * @var MovieRepository
     */
    private $movieRepository;

    public function __construct(
        SerializerInterface $serializer,
        CommandBus $commandBus,
        MovieRepository $movieRepository
    ) {
        parent::__construct($serializer, $commandBus);

        $this->movieRepository = $movieRepository;
    }

    /**
     * @SWG\Post(
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         @SWG\Schema(ref=@Model(type=App\Application\Command\Movie\MovieCreateCommand::class))
     *     ),
     *     @SWG\Response(
     *         response="201",
     *         description="Movie created"
     *     ),
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Create a movie with exploitation visa, title and year",
     *     tags={"Movie"}
     * )
     */
    public function create(Request $request): JsonResponse
    {
        $command = new MovieCreateCommand();
        var_dump($request->attributes->all());
        die;
        $form = $this->createForm(CommandType::class, $command, ['data_class' => MovieCreateCommand::class]);
        $form->submit($request->request->all(), false);

        if (!$form->isValid()) {
            throw new NotValidFormException($form);
        }

        return new JsonResponse($this->commandBus->handle($command), JsonResponse::HTTP_CREATED, [], true);
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
     *         description="The limit of movies by pages"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Returns the list of the movies",
     *     ),
     *     summary="List of the movies",
     *     tags={"Movie"}
     * )
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 10);

        $movieRepresentations = [];

        foreach ($this->movieRepository->findAll($page, $limit) as $dMovie) {
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
     *     @SWG\Response(
     *         response=200,
     *         description="Returns the list of the movies",
     *     ),
     *     summary="Read a movie from exploitation visa",
     *     tags={"Movie"}
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
