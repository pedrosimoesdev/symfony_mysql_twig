<?php

namespace App\Controller;

use App\Entity\CarsCrudMysql;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class carsController extends AbstractController
{

    /**
     * @Route("/cars", name="app_cars")
     */
    public function  index(ManagerRegistry $doctrine): \Symfony\Component\HttpFoundation\Response
    {
        $cars = $doctrine->getRepository(CarsCrudMysql::class)->findAll([], ['Name' => 'ASC']);

        if (!$cars) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
        return  $this->render("cars/index.twig",[
            'data' => $cars
        ]);
    }
    /**
     * @Route("/createCar", name="createCar")
     */

    public function create(ManagerRegistry $doctrine, Request $request): \Symfony\Component\HttpFoundation\Response
    {
        if(!empty($request->request->all())){
            $name = $request->request->get('name');
            $model = $request->request->get('model');
            $year = $request->request->get('year');

            $entityManager = $doctrine->getManager();

            $cars = new CarsCrudMysql();
            $cars->setName($name);
            $cars->setModel($model);
            $cars->setYear($year);

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($cars);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();


            echo "Record created";
            return $this->redirect('http://localhost:8000/');
        }else{
            return  $this->render("cars/create.twig");
        }
    }
    /**
     * @Route("/car/{id}", name="show")
     */
    public function show(ManagerRegistry $doctrine, int $id): \Symfony\Component\HttpFoundation\Response
    {
        $car = $doctrine->getRepository(CarsCrudMysql::class)->find($id);

        $id = $car->getId();
        $name = $car->getName();
        $model = $car->getModel();
        $year = $car->getYear();


        return  $this->render("cars/show.twig",[
          'id' => $id,
          'name' => $name,
          'model' => $model,
          'year' => $year
        ]);

    }
    /**
     * @Route("/editCar", name="edit")
     */
    public function edit(ManagerRegistry $doctrine, Request $request):  \Symfony\Component\HttpFoundation\Response
    {
        if(!empty($request->request->all())){
            $id = $request->request->get('id');
            $name = $request->request->get('name');
            $model = $request->request->get('model');
            $year = $request->request->get('year');
            $entityManager = $doctrine->getManager();

            $car = $entityManager->getRepository(CarsCrudMysql::class)->find($id);

            if (!$car) {
                throw $this->createNotFoundException(
                    'No product found for id '.$id
                );
            }

            $car->setName($name);
            $car->setModel($model);
            $car->setYear($year);
            $entityManager->flush();


            echo "Record created";
            return $this->redirect('http://localhost:8000/');
        }else{
            return  $this->render("cars/create.twig");
        }

    }

    /**
     * @Route("/carDelete/{id}", name="delete")
     */
    public function delete(ManagerRegistry $doctrine, int $id):  \Symfony\Component\HttpFoundation\Response
    {
        $entityManager = $doctrine->getManager();

        $car = $entityManager->getRepository(CarsCrudMysql::class)->find($id);



        $entityManager->remove($car);
        $entityManager->flush($car);
        return $this->redirect('http://localhost:8000/');

    }

}