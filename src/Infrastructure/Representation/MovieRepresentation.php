<?php

namespace App\Infrastructure\Representation;

use App\Domain\BoundedContext\Movie\Movie;
use JMS\Serializer\Annotation as Serializer;

class MovieRepresentation
{
    /**
     * @Serializer\Groups({
     *     "movie_read",
     *     "movie_list"
     * })
     */
    private $id;

    /**
     * @Serializer\Groups({
     *     "movie_read",
     *     "movie_list"
     * })
     */
    private $exploitationVisa;

    /**
     * @Serializer\Groups({
     *     "movie_read",
     *     "movie_list"
     * })
     */
    private $title;

    /**
     * @Serializer\Groups({
     *     "movie_read",
     *     "movie_list"
     * })
     */
    private $year;

    public function __construct(Movie $dMovie)
    {
        $this->id = $dMovie->id();
        $this->exploitationVisa = $dMovie->exploitationVisa();
        $this->title = $dMovie->title();
        $this->year = $dMovie->year();
    }
}
