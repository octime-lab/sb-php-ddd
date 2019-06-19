<?php

namespace App\Infrastructure\ParamConverter;

use App\Domain\BoundedContext\Movie\Movie;
use App\Domain\BoundedContext\Movie\MovieFinder;
use App\Domain\BoundedContext\Movie\MovieId;
use App\Domain\BoundedContext\Movie\MovieRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

final class MovieParamConverter implements ParamConverterInterface
{
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $movie = (new MovieFinder($this->movieRepository))(new MovieId($request->attributes->get('id')));

        $request->attributes->set($configuration->getName(), $movie);

        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return Movie::class === $configuration->getClass();
    }
}
