<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\BoundedContext\Movie\MovieId;
use App\Domain\BoundedContext\Movie\MovieRepository;
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

    public function search(MovieId $id): array
    {
        $fMovie = $this->movieModel->findById($id->value())->current();

        if (!$fMovie) {
            return [];
        }

        return $fMovie->extract();
    }

    public function list(int $page, int $limit): array
    {
    }

    public function delete(MovieId $id): void
    {
        $this->movieModel->deleteWhere(new Where('id = $*', [$id->value()]));
    }
}
