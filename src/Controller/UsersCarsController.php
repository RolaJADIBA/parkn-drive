<?php

namespace App\Controller;

use App\Entity\UsersCars;
use App\Form\UsersCarsType;
use App\Repository\UsersCarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class UsersCarsController extends AbstractController
{
    /**
     * @Route("/users/cars", name="users_cars_index", methods={"GET"})
     */
    public function index(UsersCarsRepository $usersCarsRepository): Response
    {
        return $this->render('admin/users_cars/index.html.twig', [
            'users_cars' => $usersCarsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/users/cars/new", name="users_cars_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $usersCar = new UsersCars();
        $form = $this->createForm(UsersCarsType::class, $usersCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usersCar);
            $entityManager->flush();

            return $this->redirectToRoute('users_cars_index');
        }

        return $this->render('admin/users_cars/new.html.twig', [
            'users_car' => $usersCar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/cars/{id}", name="users_cars_show", methods={"GET"})
     */
    public function show(UsersCars $usersCar): Response
    {
        return $this->render('admin/users_cars/show.html.twig', [
            'users_car' => $usersCar,
        ]);
    }

    /**
     * @Route("/users/cars/{id}/edit", name="users_cars_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UsersCars $usersCar): Response
    {
        $form = $this->createForm(UsersCarsType::class, $usersCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users_cars_index');
        }

        return $this->render('admin/users_cars/edit.html.twig', [
            'users_car' => $usersCar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/cars/{id}", name="users_cars_delete", methods={"POST"})
     */
    public function delete(Request $request, UsersCars $usersCar): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usersCar->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usersCar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users_cars_index');
    }
}
