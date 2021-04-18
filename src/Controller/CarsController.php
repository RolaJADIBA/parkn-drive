<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Form\CarsType;
use App\Repository\CarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class CarsController extends AbstractController
{
    /**
     * @Route("/cars", name="cars_index", methods={"GET"})
     */
    public function index(CarsRepository $carsRepository): Response
    {
        return $this->render('admin/cars/index.html.twig', [
            'cars' => $carsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/cars/new", name="cars_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $car = new Cars();
        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();

            $nouveau_nom = md5(uniqid()).'.'.$image->guessExtension();

            $image->move(
                $this->getParameter('image_cars'),
                $nouveau_nom
            );

            $car->setImage($nouveau_nom);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('cars_index');
        }

        return $this->render('admin/cars/new.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cars/{id}", name="cars_show", methods={"GET"})
     */
    public function show(Cars $car): Response
    {
        return $this->render('admin/cars/show.html.twig', [
            'car' => $car,
        ]);
    }

    /**
     * @Route("/cars/{id}/edit", name="cars_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cars $car): Response
    {
        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        $ancienne_photo = $car->getImage();

        if ($form->isSubmitted() && $form->isValid()) {

            if($ancienne_photo != null){

                $filesystem= new Filesystem();

                $filesystem->remove('cars/' . $ancienne_photo);

                $image = $form->get('image')->getData();

                $nouveau_nom = md5(uniqid()) .'.'. $image->guessExtension();

                $image->move(
                    $this->getParameter('image_cars'),
                    $nouveau_nom
                );

                $car->setImage($nouveau_nom);

            }else{

                $car->setImage($ancienne_photo);

            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cars_index');
        }

        return $this->render('admin/cars/edit.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cars/{id}", name="cars_delete", methods={"POST"})
     */
    public function delete(Request $request, Cars $car): Response
    {
        $ancienne_photo = $car->getImage();

        if($car->getImage()){

            $filesystem = new Filesystem();
            $filesystem->remove('cars/' . $ancienne_photo);

        }

        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cars_index');
    }

    /**
     * @Route("/cars/active/{id}", name="cars_active")
     */
    public function activeCar(Cars $car)
    {
        $car->setActive(($car->getActive()) ? false : true);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($car);
        $entityManager->flush();

        return new Response("true");
    }
}
