<?php

namespace App\Infrastructure\Repository;

use App\Domain\BoundedContext\Movie\MovieRepository;
use App\Domain\BoundedContext\Movie\Movies;
use App\Domain\BoundedContext\Movie\Movie;
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

    public function findById(string $id): ?Movie
    {
        $fMovie = $this->movieModel->findById($id)->current();

        if (!$fMovie) {
            return null;
        }

        return $this->movieDTO->flexibleToDomain($fMovie);
    }

    public function list(int $page, int $limit): Movies
    {
        $movies = new Movies();

        foreach ($this->movieModel->list($page, $limit) as $fTask) {
            $movies->append($this->movieDTO->flexibleToDomain($fTask));
        }

        return $movies;
    }

    public function deleteById(string $id): void
    {
        $this->movieModel->deleteWhere(new Where('id = $*', [$id]));
    }
}
