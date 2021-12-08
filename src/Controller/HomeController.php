<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="home_")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(PhotoRepository $photoRepository): Response
    {

        return $this->render('home/index.html.twig', ['photos' => $photoRepository->findAll()]);
    }
}