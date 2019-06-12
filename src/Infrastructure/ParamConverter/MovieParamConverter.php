<?php

namespace App\Infrastructure\ParamConverter;

use App\Domain\BoundedContext\Movie\Entity\Movie;
use App\Domain\BoundedContext\Movie\Repository\MovieRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class MovieParamConverter implements ParamConverterInterface
{
    /**
     * @var MovieRepositoryInterface
     */
    private $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function apply(Request $request, ParamConverter $configuration): bool
    {
        if (null === $movie = $this->movieRepository->findByExploitationVisa($request->attributes->get('id'))) {
            throw new NotFoundHttpException('movie.not_exits');
        }

        $request->attributes->set($configuration->getName(), $movie);

        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return Movie::class === $configuration->getClass();
    }
}
