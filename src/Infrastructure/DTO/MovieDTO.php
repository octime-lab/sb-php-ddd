<?php

namespace App\Infrastructure\DTO;

use App\Domain\BoundedContext\Movie\ValueObject\MovieExploitationVisa;
use App\Domain\Shared\Entity\DomainEntityInterface;
use App\Domain\BoundedContext\Movie\Entity\Movie as DomainMovie;
use App\Infrastructure\Model\Db\PublicSchema\Movie as FlexibleMovie;
use PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface;

final class MovieDTO implements DTOInterface
{
    public function domainToFlexible(DomainEntityInterface $dMovie): FlexibleEntityInterface
    {
        $fMovie = new FlexibleMovie();

        $movieData = [];
        $movieData['exploitation_visa'] = $dMovie->getExploitationVisa();
        $movieData['title'] = $dMovie->getTitle();
        $movieData['year'] = $dMovie->getYear();

        $fMovie->hydrate($movieData);

        return $fMovie;
    }

    public function flexibleToDomain(FlexibleEntityInterface $fMovie): DomainEntityInterface
    {
        $movieData = $fMovie->extract();

        $dMovie = new DomainMovie(
            new MovieExploitationVisa($movieData['exploitation_visa']),
            $movieData['title'],
            $movieData['year']
        );

        return $dMovie;
    }
}
