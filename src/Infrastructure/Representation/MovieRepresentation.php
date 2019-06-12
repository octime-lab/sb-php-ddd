<?php

namespace App\Infrastructure\Representation;

use App\Domain\BoundedContext\Movie\Entity\Movie;
use JMS\Serializer\Annotation as Serializer;

class MovieRepresentation
{
    /**
     * @var string
     *
     * @Serializer\Groups({
     *     "movie_read",
     *     "movie_list"
     * })
     */
    private $exploitationVisa;

    /**
     * @var string
     *
     * @Serializer\Groups({
     *     "movie_read",
     *     "movie_list"
     * })
     */
    private $title;

    /**
     * @var int
     *
     * @Serializer\Groups({
     *     "movie_read",
     *     "movie_list"
     * })
     */
    private $year;

    public function __construct(Movie $dMovie)
    {
        $this->exploitationVisa = $dMovie->getExploitationVisa();
        $this->title = $dMovie->getTitle();
        $this->year = $dMovie->getYear();
    }
}
