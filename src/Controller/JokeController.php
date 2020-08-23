<?php

namespace App\Controller;

use App\Entity\Joke;
use App\Repository\JokeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class JokeController extends AbstractController
{
    /**
     * List the joke resources.
     *
     * @return JsonResponse
     * @Route("/api/jokes", name="jokes_list", methods={"GET","HEAD"})
     * @TODO add pagination with
     *  - number jokes per page
     *  - total count
     *  - page number
     */
    public function index(): JsonResponse
    {
        $jokes = $this->getDoctrine()
            ->getRepository(Joke::class)
            ->getAll();

        // TODO should I check for none and send message?
        return new JsonResponse($jokes, 200);
    }

    /**
     * Add the joke resource.
     *
     * @return JsonResponse
     * @Route("/api/jokes", name="joke_create", methods={"POST"})
     */
    public function store(): JsonResponse
    {
        // TODO implement
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->flush();
    }

    /**
     * Find and return the joke resource.
     *
     * @param int $id
     * @return JsonResponse
     *
     * @Route("/api/jokes/{id}", name="joke_show", methods={"GET"})
     */
    public function show(int $id): JsonResponse
    {
        $joke = $this->getDoctrine()
            ->getRepository(Joke::class)
            ->find($id);

        if (!$joke) {
            throw $this->createNotFoundException(
                'No joke found for id '.$id
            );
        }

        return new JsonResponse($joke, 200);
    }

    /**
     * Delete the joke resource.
     *
     * @param int $id
     * @return JsonResponse
     *
     * @Route("/api/jokes/{id}", name="joke_delete", methods={"DELETE"})
     */
    public function destroy(int $id): JsonResponse
    {
        // TODO implement
    }

    /**
     * Return a random joke.
     *
     * @return JsonResponse
     * @Route("/api/jokes/random", name="joke_random", methods={"GET"})
     */
    public function random(): JsonResponse
    {
        // TODO implement
        // get count of jokes (or get list of id's)
        // randomly select one and return it
    }
}