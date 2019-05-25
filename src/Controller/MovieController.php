<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/movie")
 */
class MovieController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/", name="movie_index", methods={"GET"})
     */
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $this->serializer->serialize($movieRepository->findAll(), 'json');
        return new JsonResponse(json_decode($movies));
    }

    /**
     * @Route("/add", name="movie_add", methods={"POST"})
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $movie = new Movie();
        $movie->setName($request->request->get('name'));
        $movie->setUrl($request->request->get('url'));
        $entityManager->persist($movie);
        $entityManager->flush();
        return new JsonResponse();
    }

    /**
     * @Route("/{id}", name="movie_show", methods={"GET"})
     */
    public function show(Movie $movie): Response
    {
        $movieSerialize = $this->serializer->serialize($movie, 'json');
        return new JsonResponse(json_decode($movieSerialize));
    }
}
