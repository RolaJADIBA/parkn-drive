<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Entity\Users;
use App\Entity\UsersCars;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/driver")
 * @IsGranted("ROLE_DRIVER")
 */
class DriverController extends AbstractController
{
    /**
     * @Route("/", name="driver")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $cars = $this->getDoctrine()->getRepository(UsersCars::class)->findBy(['users' => $user]);

        return $this->render('driver/index.html.twig', [
            'cars' => $cars
        ]);
    }

    /**
     * @Route("/driver/car/show", name="driver_car_show")
     */
    public function showCars()
    {
        $cars = $this->getDoctrine()->getRepository(Cars::class)->findAll();

        return $this->render('driver/showCars.html.twig',[
            'cars' => $cars
        ]);
    }

    /**
     * @Route("/driver/car/add/{id}", name="driver_car_add")
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

        return $this->redirectToRoute('driver');
    }

    /**
     * @Route("/driver/car/delete/{id}", name="driver_car_delete")
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

        return $this->redirectToRoute('driver');
    }

    /**
     * @Route("/increase/{distance}/{id}", name="driver_distance_increase")
     */
    public function increaseDistance($distance, $id)
    {
        $car = $this->getDoctrine()->getRepository(Cars::class)->find($id);

        $car->setMileage($distance);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($car);
        $entityManager->flush();

        return $this->redirectToRoute('driver');
    }

    /**
     * @Route("/seeHouses", name="driver_seeHouses")
     */
    public function seeHouses()
    {
        // $users = $this->getDoctrine()->getRepository(Users::class)->findBy(['roles' => '[ROLE_DRIVER]']);

        $users = $this->getDoctrine()->getRepository(Users::class)->findAll();

        // dd($users);

        return $this->render('driver/showUsers.html.twig',[
            'users' => $users
        ]);

    }


}
