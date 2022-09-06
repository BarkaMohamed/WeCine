<?php

namespace App\Manager;

use App\Client\TheMovieDBInterface;

class MoviesManager implements MoviesManagerInterface
{

    private $theMovieDBClient;

    public function __construct(TheMovieDBInterface $theMovieDBClient)
    {
        $this->theMovieDBClient = $theMovieDBClient;
    }

    /**
     * @return array
     */
    public function getGenderList(): array
    {
        $genderListResponse = $this->theMovieDBClient->getGenderList();
        return array_key_exists('genres', $genderListResponse) ? $genderListResponse['genres'] : [];
    }

    /**
     * @return array
     */
    public function getBestMovie(): ?array
    {
        $topRatedMovies = $this->theMovieDBClient->getTopRatedMovies();
        return array_key_exists('results', $topRatedMovies) && count($topRatedMovies['results']) ? $topRatedMovies['results'][0] : null;
    }


    public function getMoviesByGenders($genderIds): array
    {
        $moviesByGender = $this->theMovieDBClient->getMoviesByGenders($genderIds);
        return array_key_exists('results', $moviesByGender) ? $moviesByGender['results'] : [];

    }

    public function getMovieVideos(int $movieId): ?array
    {
        $movieVideos = $this->theMovieDBClient->getMovieVideos($movieId);

        return array_key_exists('results', $movieVideos) && count($movieVideos['results']) ? $movieVideos['results'][0] : null;

    }

    public function getMoviesByQuery(string $query): array
    {
        $movies = $this->theMovieDBClient->getMoviesByQuery($query);
        return array_key_exists('results', $movies) ? $movies['results'] : [];
    }
}