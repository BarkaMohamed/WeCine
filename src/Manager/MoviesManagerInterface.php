<?php

namespace App\Manager;

interface MoviesManagerInterface
{
    /**
     * @return array
     */
    public function getGenderList(): array;

    /**
     * @return array
     */
    public function getBestMovie(): ?array;

    /**
     * @param $genderIds
     * @return array
     */
    public function getMoviesByGenders($genderIds): array;

    public function getMovieVideos(int $movieId): ?array;

    /**
     * @param string $query
     * @return array
     */
    public function getMoviesByQuery(string $query):array;

}