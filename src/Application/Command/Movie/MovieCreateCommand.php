<?php

namespace App\Application\Command\Movie;

use App\Infrastructure\Command\Command;
use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     type="object",
 *     required={"exploitationVisa", "title", "year"},
 *     title="Movie",
 *     description="A movie definition"
 * )
 */
class MovieCreateCommand extends Command
{
    /**
     * @SWG\Property(
     *     type="string",
     *     description="The movie's exploitation visa",
     *     example="134.523",
     * )
     */
    public $exploitationVisa;

    /**
     * @SWG\Property(
     *     type="string",
     *     description="The movie's title",
     *     example="Rambo first blood"
     * )
     */
    public $title;

    /**
     * @SWG\Property(
     *     type="integer",
     *     description="The movie's year",
     *     format="int16",
     *     example=1980
     * )
     */
    public $year;
}
