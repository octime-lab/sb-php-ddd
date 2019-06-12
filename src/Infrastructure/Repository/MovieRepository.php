<?php

namespace App\Infrastructure\Repository;

use App\Domain\BoundedContext\Movie\Collection\MovieCollection;
use App\Domain\BoundedContext\Movie\Entity\Movie;
use App\Domain\BoundedContext\Movie\Repository\MovieRepositoryInterface;
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

    public function save(Movie $dMovie): void
    {
        $this->movieModel->insertOne($this->movieDTO->domainToFlexible($dMovie));
    }

    public function findByExploitationVisa(string $exploitationVisa): Movie
    {
        $fMovie = $this->movieModel->findByExploitationVisa($exploitationVisa)->current();

        if (!$fMovie) {
            return null;
        }

        return $this->movieDTO->flexibleToDomain($fMovie);
    }

    public function findAll(int $page, int $limit): MovieCollection
    {
        $movieCollection = new MovieCollection();

        foreach ($this->movieModel->list($page, $limit) as $fTask) {
            $movieCollection->append($this->movieDTO->flexibleToDomain($fTask));
        }

        return $movieCollection;
    }
}
