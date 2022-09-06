<?php

namespace App\Client;

interface TheMovieDBInterface
{
    /**
     * GET Movie Details
     * @param string $movieId
     * @return array
     */
    public function getMovie(string $movieId): array;

    /**
     * GET Movies Gender List
     * @return array
     */
    public function getGenderList(): array;

    /**
     * GET Top Rated Movies
     * @return array
     */
    public function getTopRatedMovies(): array;

    /**
     * GET Movie Videos
     * @param string $movieId
     * @return array
     */
    public function getMovieVideos(string $movieId): array;

    /**
     * Get Movies By Genders
     * @param array $genders
     * @return array
     */
    public function getMoviesByGenders(array $genders):array;

    /**
     * GET Movies By Query
     * @param string $query
     * @return array
     */
    public function getMoviesByQuery(string $query):array;

}