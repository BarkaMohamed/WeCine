<?php

namespace App\Client;


use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TheMovieDbClient implements TheMovieDBInterface
{

    const API_URL = 'api_url';
    const API_VERSION = 'api_version';
    const API_KEY = 'api_key';
    const API_LANGUAGE = 'api_language';

    const MOVIE_URI = '/movie';
    const SEARCH_URI = '/search';
    const TOP_RATED_MOVIES_URI = '/movie/top_rated';
    const GENDER_MOVIE_LIST_URI = '/genre/movie/list';
    const VIDEOS_URI = '/videos';
    const DISCOVER_URI = '/discover';
    const WITH_GENDERS = 'with_genres';
    const QUERY = 'query';

    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $version;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var array
     */
    private $queryParameters;

    /**
     * @param array $moviesApiConfig
     * @param HttpClientInterface $httpClient
     */
    public function __construct(array $moviesApiConfig, HttpClientInterface $httpClient)
    {
        $this->url = $moviesApiConfig[self::API_URL];
        $this->version = $moviesApiConfig[self::API_VERSION];
        $this->httpClient = $httpClient;
        $this->queryParameters = [self::QUERY => [self::API_KEY => $moviesApiConfig[self::API_KEY], self::API_LANGUAGE => $moviesApiConfig[self::API_LANGUAGE]]];
    }

    /**
     * @param $movieId
     * @return array
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getMovie($movieId): array
    {
        $url = $this->getURL() . self::MOVIE_URI . '/' . $movieId;
        $response = $this->httpClient->request('GET', $url, $this->queryParameters);

        return $response->toArray();
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getGenderList(): array
    {
        $url = $this->getURL() . self::GENDER_MOVIE_LIST_URI;
        $response = $this->httpClient->request('GET', $url, $this->queryParameters);
        return $response->toArray();
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getTopRatedMovies(): array
    {
        $url = $this->getURL() . self::TOP_RATED_MOVIES_URI;
        $response = $this->httpClient->request('GET', $url, $this->queryParameters);

        return $response->toArray();
    }


    /**
     * Get Movie Videos
     * @param string $movieId
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMovieVideos(string $movieId): array
    {
        $url = $this->getURL() . self::MOVIE_URI . '/' . $movieId . self::VIDEOS_URI;
        $response = $this->httpClient->request('GET', $url, $this->queryParameters);

        return $response->toArray();
    }

    /**
     * GET Movies By Genders
     * @param array $genders
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMoviesByGenders(array $genders): array
    {
        $url = $this->getURL() . self::DISCOVER_URI . self::MOVIE_URI;
        $this->queryParameters[self::QUERY] = $this->addQueryParameters([self::WITH_GENDERS => implode(',', $genders)]);

        $response = $this->httpClient->request('GET', $url, $this->queryParameters);

        return $response->toArray();
    }

    /**
     * GET Movies By Query
     * @param string $query
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMoviesByQuery(string $query): array
    {
        $url = $this->getURL() . self::SEARCH_URI . self::MOVIE_URI;
        $this->queryParameters[self::QUERY] = $this->addQueryParameters([self::QUERY => $query]);

        $response = $this->httpClient->request('GET', $url, $this->queryParameters);

        return $response->toArray();
    }

    /**
     * Adding query parameters to request
     * @param array $params
     * @return array
     */
    private function addQueryParameters(array $params): array
    {
        return array_merge($this->queryParameters[self::QUERY], $params);
    }

    /**
     * @return string
     */
    private function getURL(): string
    {
        return $this->url . '/' . $this->version;
    }


}