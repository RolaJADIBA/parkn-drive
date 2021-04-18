<?php

namespace App\Controller;
use App\Entity\UsersCars;
use App\Entity\Cars;
use App\Entity\Users;
use App\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDefaultController extends AbstractController
{
    /**
     * @Route("/user/default", name="user_default")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $cars = $this->getDoctrine()->getRepository(UsersCars::class)->findBy(['users' => $user]);

        return $this->render('user_default/index.html.twig', [
            'cars' => $cars
        ]);
    }

    /**
     * @Route("/user/car/show", name="user_car_show")
     */
    public function showCars()
    {
        $cars = $this->getDoctrine()->getRepository(Cars::class)->findAll();

        return $this->render('user_default/showCars.html.twig',[
            'cars' => $cars
        ]);
    }

    /**
     * @Route("/user/car/add/{id}", name="user_car_add")
     */
    public function addCar($id)
    {
        $user = $this->getUser();
        $car = $this->getDoctrine()->getRepository(Cars::class)->find($id);

        $userCar = new UsersCars();
        $userCar->setUsers($user);
        $userCar->setCars($car);

        $car->setActive(true);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($userCar);
        $entityManager->persist($car);
        $entityManager->flush();

        return $this->redirectToRoute('user_default');
    }

    /**
     * @Route("/user/car/delete/{id}", name="user_car_delete")
     */
    public function deleteCar($id)
    {
        $user = $this->getUser();
        $car = $this->getDoctrine()->getRepository(Cars::class)->find($id);

        $userCar = $this->getDoctrine()->getRepository(UsersCars::class)->findOneBy([
            'users' => $user,
            'cars' => $car
        ]);

        $car->setActive(false);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($car);
        $entityManager->remove($userCar);
        $entityManager->flush();

        return $this->redirectToRoute('user_default');
    }

    /**
     * @Route("/user/showInfo", name="user_showInfo")
     */
    public function showInfo()
    {
        $user = $this->getUser();
        // dd($user);
        return $this->render('user_default/showUserInfo.html.twig',[
            'user' => $user
        ]);

    }


    /**
     * @Route("/user/editInfo/{id}", name="user_editInfo")
     */
    public function editInfo(Request $request, Users $user)
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_showInfo');
        }

        return $this->render('user_default/editInfo.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);


    }


}
