<?php

namespace App\Controller;

use App\Entity\Joke;
use App\Repository\JokeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class JokeController extends AbstractController
{
    /**
     * List the joke resources with pagination.
     *
     * @param PaginatorInterface $paginator
     * @param Request $request
     *
     * @return JsonResponse
     * @Route("/api/jokes", name="jokes_list", methods={"GET","HEAD"})
     */
    public function index(PaginatorInterface $paginator, Request $request): JsonResponse
    {
        $limit = $request->query->getInt('limit', 10);
        $page = $request->query->getInt('page', 1);

        $pagination = $paginator->paginate(
            $this->getDoctrine()->getRepository(Joke::class)->getAll(),
            $page,
            $limit
        );

        $results = [
            'count' => $pagination->getTotalItemCount(),
            'page' => $pagination->getCurrentPageNumber(),
            'limit' => $pagination->getItemNumberPerPage(),
            '_embedded' => [
                'jokes' => $pagination->getItems(),
            ],
        ];

        return new JsonResponse($results, JsonResponse::HTTP_OK);
    }

    /**
     * Add the joke resource.
     *
     * @param ValidatorInterface $validator
     * @param Request $request
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     * @Route("/api/jokes", name="joke_create", methods={"POST"})
     */
    public function store(ValidatorInterface $validator, Request $request, SerializerInterface $serializer): JsonResponse
    {
        $date = new \DateTime();

        $entityManager = $this->getDoctrine()->getManager();

        $joke = new Joke();
        $joke->setJoke($request->get('joke'));
        $joke->setCreatedAt($date);
        $joke->setUpdatedAt($date);

        $errors = $validator->validate($joke);

        if (count($errors)) {
            $errorString = (string) $errors;
            return new JsonResponse(['errors' => $errorString], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->persist($joke);
        $entityManager->flush();

        $responseData = [
            'success' => true,
            'data' => $serializer->serialize($joke, 'json'),
        ];

        return new JsonResponse($responseData, JsonResponse::HTTP_CREATED);
    }

    /**
     * Return a random joke.
     *
     * @return JsonResponse
     * @Route("/api/jokes/random", name="joke_random", methods={"GET"})
     */
    public function random(): JsonResponse
    {
        $joke = $this->getDoctrine()
            ->getRepository(Joke::class)
            ->getRandomJoke();

        return new JsonResponse($joke, JsonResponse::HTTP_OK);
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
        $joke = $this->getJokeArrayById($id);

        if (!$joke) {
            throw $this->createNotFoundException(
                'No joke found for id '.$id
            );
        }

        return new JsonResponse($joke, JsonResponse::HTTP_OK);
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
        $entityManager = $this->getDoctrine()->getManager();

        $joke = $this->getDoctrine()
            ->getRepository(Joke::class)
            ->find($id);

        if (!$joke) {
            throw $this->createNotFoundException(
                'No joke found for id '.$id
            );
        }

        $entityManager->remove($joke);
        $entityManager->flush();

        return new JsonResponse(['success' => true], JsonResponse::HTTP_OK);
    }

    protected function getJokeArrayById(int $id): ?array
    {
        return $this->getDoctrine()
            ->getRepository(Joke::class)
            ->getById($id);
    }
}
