<?php

namespace App\Controller;

use App\Entity\Houses;
use App\Form\HousesType;
use App\Repository\HousesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class HousesController extends AbstractController
{
    /**
     * @Route("/houses", name="houses_index", methods={"GET"})
     */
    public function index(HousesRepository $housesRepository): Response
    {
        return $this->render('admin/houses/index.html.twig', [
            'houses' => $housesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/houses/new", name="houses_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $house = new Houses();
        $form = $this->createForm(HousesType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($house);
            $entityManager->flush();

            return $this->redirectToRoute('houses_index');
        }

        return $this->render('admin/houses/new.html.twig', [
            'house' => $house,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/houses/{id}", name="houses_show", methods={"GET"})
     */
    public function show(Houses $house): Response
    {
        return $this->render('admin/houses/show.html.twig', [
            'house' => $house,
        ]);
    }

    /**
     * @Route("/houses/{id}/edit", name="houses_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Houses $house): Response
    {
        $form = $this->createForm(HousesType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('houses_index');
        }

        return $this->render('admin/houses/edit.html.twig', [
            'house' => $house,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/houses/{id}", name="houses_delete", methods={"POST"})
     */
    public function delete(Request $request, Houses $house): Response
    {
        if ($this->isCsrfTokenValid('delete'.$house->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($house);
            $entityManager->flush();
        }

        return $this->redirectToRoute('houses_index');
    }
}
