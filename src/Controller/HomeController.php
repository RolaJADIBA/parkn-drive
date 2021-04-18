<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /*************ACCUEIL ADMIN**************** */

    /**
     * @Route("/admin", name="home_admin")
     */
    public function indexAdmin()
    {
        return $this->render('admin.html.twig');
    }

}
