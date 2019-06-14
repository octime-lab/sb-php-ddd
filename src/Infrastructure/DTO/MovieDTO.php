<?php

namespace App\Infrastructure\DTO;

use App\Domain\BoundedContext\Movie\MovieTitle;
use App\Domain\BoundedContext\Movie\MovieYear;
use App\Domain\Shared\Entity\DomainEntityInterface;
use App\Domain\BoundedContext\Movie\Movie as DomainMovie;
use App\Infrastructure\Model\Db\PublicSchema\Movie as FlexibleMovie;
use PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface;

final class MovieDTO implements DTOInterface
{
    public function domainToFlexible(DomainEntityInterface $dMovie): FlexibleEntityInterface
    {
        $fMovie = new FlexibleMovie();

        $movieData = [];
        $movieData['exploitation_visa'] = $dMovie->exploitationVisa();
        $movieData['title'] = $dMovie->title();
        $movieData['year'] = $dMovie->year();

        $fMovie->hydrate($movieData);

        return $fMovie;
    }

    public function flexibleToDomain(FlexibleEntityInterface $fMovie): DomainEntityInterface
    {
        return new DomainMovie(
            new MovieExploitationVisa($fMovie->get('exploitation_visa')),
            new MovieTitle($fMovie->get('title')),
            new MovieYear($fMovie->get('year'))
        );
    }
}
