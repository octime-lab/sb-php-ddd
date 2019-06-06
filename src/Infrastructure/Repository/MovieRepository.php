<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Movie;
use App\Domain\Repository\MovieRepositoryInterface;
use App\Infrastructure\DTO\MovieDTO;
use App\Infrastructure\Model\Db\PublicSchema\MovieModel;

final class MovieRepository implements MovieRepositoryInterface
{
    /**
     * @var MovieModel
     */
    private $movieModel;

    /**
     * @var MovieDTO
     */
    private $movieDTO;

    public function __construct(MovieModel $movieModel, MovieDTO $movieDTO)
    {
        $this->movieModel = $movieModel;
        $this->movieDTO = $movieDTO;
    }

    public function findByExploitationVisa(string $exploitationVisa): Movie
    {
        $fMovie = $this->movieModel->findByExploitationVisa($exploitationVisa)->current();

        if (!$fMovie) {
            return null;
        }

        return $this->movieDTO->flexibleToDomain($fMovie);
    }
}
