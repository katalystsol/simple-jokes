<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JokeController extends AbstractController
{
    /**
     * @Route("/api/jokes", name="jokes_list", methods={"GET","HEAD"})
     */
    public function index()
    {

    }

    /**
     * @Route("/api/jokes/create", name="joke_create", methods={"GET"})
     */
    public function create()
    {

    }

    /**
     * @Route("/api/jokes", name="joke_create", methods={"POST"})
     */
    public function store()
    {

    }

    /**
     * @Route("/api/jokes/{id}", name="joke_show", methods={"GET"})
     */
    public function show(int $id)
    {

    }

    /**
     * @Route("/api/jokes/{id}", name="joke_delete", methods={"DELETE"})
     */
    public function destroy(int $id)
    {

    }
}