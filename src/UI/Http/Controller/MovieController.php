<?php

declare(strict_types=1);

namespace App\UI\Http\Controller;

use App\Application\Command\Movie\MovieCreateCommand;
use App\Application\Command\Movie\MovieDeleteCommand;
use App\Application\Query\Movie\MovieFindQuery;
use App\Infrastructure\Shared\Exception\NotValidFormException;
use App\Infrastructure\Shared\Utils\Utils;
use App\Infrastructure\Shared\Bus\Command\CommandType;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends RestController
{
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
     *         @SWG\Schema(ref=@Model(type=App\Infrastructure\Shared\Bus\Command\Error::class))
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

        return new JsonResponse($this->dispatch($command), JsonResponse::HTTP_CREATED);
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
     *         @SWG\Schema(ref=@Model(type=App\Infrastructure\Shared\Bus\Command\Error::class))
     *     ),
     *     summary="Deletes a single movie based on the ID supplied",
     *     tags={"Movie"}
     * )
     */
    public function delete(): JsonResponse
    {
        $command = new MovieDeleteCommand();
        //  $command->id = $movie->id();

        return new JsonResponse($this->dispatch($command), JsonResponse::HTTP_NO_CONTENT);
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
     *         @SWG\Schema(ref=@Model(type=App\Infrastructure\Shared\Bus\Command\Error::class))
     *     ),
     *     summary="Returns all movies from the system that the user has access to",
     *     tags={"Movie"}
     * )
     */
    public function list(Request $request): JsonResponse
    {
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 10);

        // todo
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
     *         @SWG\Schema(ref=@Model(type=App\Infrastructure\Shared\Bus\Command\Error::class))
     *     ),
     *     summary="Returns a movie",
     *     tags={"Movie"}
     * )
     */
    public function read(string $id): JsonResponse
    {
        return $this->jsonResponse($this->ask(new MovieFindQuery($id)));
    }
}
