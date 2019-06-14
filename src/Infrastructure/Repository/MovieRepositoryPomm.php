<?php

namespace App\Infrastructure\Repository;

use App\Domain\BoundedContext\Movie\Collection\MovieCollection;
use App\Domain\BoundedContext\Movie\Entity\Movie;
use App\Domain\BoundedContext\Movie\Repository\MovieRepositoryInterface;
use App\Infrastructure\DTO\MovieDTO;
use App\Infrastructure\Model\Db\PublicSchema\MovieModel;
use PommProject\Foundation\Where;

final class MovieRepositoryPomm implements MovieRepository
{
    private $movieModel;

    private $movieDTO;

    public function __construct(MovieModel $movieModel, MovieDTO $movieDTO)
    {
        $this->movieModel = $movieModel;
        $this->movieDTO = $movieDTO;
    }

    public function create(Movie $dMovie): void
    {
        $fMovie = $this->movieDTO->domainToFlexible($dMovie);

        $this->movieModel->insertOne($fMovie);
    }

    public function findByExploitationVisa(string $exploitationVisa): ?Movie
    {
        $fMovie = $this->movieModel->findByExploitationVisa($exploitationVisa)->current();

        if (!$fMovie) {
            return null;
        }

        return $this->movieDTO->flexibleToDomain($fMovie);
    }

    public function list(int $page, int $limit): MovieCollection
    {
        $movieCollection = new MovieCollection();

        foreach ($this->movieModel->list($page, $limit) as $fTask) {
            $movieCollection->append($this->movieDTO->flexibleToDomain($fTask));
        }

        return $movieCollection;
    }

    public function deleteByExploitationVisa(string $exploitationVisa): void
    {
        $this->movieModel->deleteWhere(new Where('exploitation_visa = $*', [$exploitationVisa]));
    }
}
