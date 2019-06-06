<?php

namespace App\Infrastructure\DTO;

use App\Domain\Entity\DomainEntityInterface;
use App\Domain\Entity\Movie as DomainMovie;
use App\Infrastructure\Model\Db\PublicSchema\Movie as FlexibleMovie;
use PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface;

final class MovieDTO implements DTOInterface
{
    public function domainToFlexible(DomainEntityInterface $dMovie): FlexibleEntityInterface
    {
        $fMovie = new FlexibleMovie();
        $tmpMovieData = $dMovie->toArray();

        $movieData = [];
        $movieData['exploitation_visa'] = $tmpMovieData['exploitationVisa'];
        $movieData['title'] = $tmpMovieData['title'];
        $movieData['year'] = $tmpMovieData['title'];

        $fMovie->hydrate($movieData);

        return $fMovie;
    }

    public function flexibleToDomain(FlexibleEntityInterface $fMovie): DomainEntityInterface
    {
        $movieData = $fMovie->extract();

        $dMovie = new DomainMovie(
            $movieData['exploitation_visa'],
            $movieData['title'],
            $movieData['year']
        );

        return $dMovie;
    }
}
