<?php

namespace App\Controller;

use App\Client\TheMovieDBInterface;
use App\Manager\MoviesManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/api/movies")
 */
class MoviesController extends AbstractFOSRestController
{
    /**
     * @var MoviesManagerInterface
     */
    private $moviesManager;

    /**
     * @param MoviesManagerInterface $moviesManager
     */
    public function __construct(MoviesManagerInterface $moviesManager)
    {
        $this->moviesManager = $moviesManager;
    }

    /**
     * @Rest\Get("/gender/list")
     * @View(
     *     statusCode = 200
     * )
     */
    public function genderList()
    {
        return $this->moviesManager->getGenderList();
    }

    /**
     * @Rest\Get("/by/gender")
     * @View(
     *     statusCode = 200
     * )
     */
    public function moviesByGender(Request $request)
    {
        $genderIds = $request->get('id');
        return $this->moviesManager->getMoviesByGenders($genderIds);
    }

    /**
     * @Rest\Get("/best")
     * @View(
     *     statusCode = 200
     * )
     */
    public function bestMovie()
    {
        return $this->moviesManager->getBestMovie();
    }

    /**
     * @Rest\Get("/videos/{movieId}")
     * @View(
     *     statusCode = 200
     * )
     */
    public function moviesVideos(int $movieId)
    {
        return $this->moviesManager->getMovieVideos($movieId);
    }

    /**
     * @Rest\Get("/search/{query}")
     * @View(
     *     statusCode = 200
     * )
     */
    public function moviesSearch(string $query)
    {
        return $this->moviesManager->getMoviesByQuery($query);
    }
}