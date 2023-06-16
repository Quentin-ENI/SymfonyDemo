<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/animal', name: 'animal_')]
class AnimalController extends AbstractController
{
    private $animals = [
            1 => ["Elephant", "Inde"],
            2 => ["Tigre", "Inde"],
            3 => ["Lion", "Ethiopie"],
            4 => ["Flamant rose", "Egypte"]
    ];

    #[Route('/', name: 'list')]
    public function list(AnimalRepository $animalRepository): Response
    {
        $animals = $animalRepository->findAll();
        $animalsCount = $animalRepository->count([]);
        return $this->render('animal/index.html.twig', [
            'animals' => $animals,
            'animalsCount' => $animalsCount
        ]);
    }

    /**
     * @param $id
     * @return Response
     */
    #[Route(
        '/{id}',
        name: 'details',
        requirements: ["id" => "\d+"],
        methods: ["GET"]
    )]
    public function details($id, AnimalRepository $animalRepository): Response
    {
        $animal = $animalRepository->find($id);

        return $this->render('animal/details.html.twig', [
            "animal" => $animal
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $animal = new Animal();
        $animalForm = $this->createForm(AnimalType::class, $animal);

        $animalForm->handleRequest($request);

        if ($animalForm->isSubmitted() && $animalForm->isValid()) {
            try {
                $entityManager->persist($animal);
                $entityManager->flush();
                $this->addFlash('success', "L'animal a bien été inséré en base de données.");
            } catch (Exception $exception) {
                $this->addFlash('danger', "L'animal n'a pas été inséré en base de données.");
            }
        }

        return $this->render('animal/create.html.twig', [
            "animalForm" => $animalForm->createView()
        ]);
    }

    #[Route('/custom', name: 'custom')]
    public function custom(AnimalRepository $animalRepository): Response
    {
//        $animals = $animalRepository->findBy(["name" => "Bertrand"]);
//        return $this->render('animal/custom.html.twig', [
//            'animals' => $animals
//        ]);
        $animal = $animalRepository->findOneBy(["name" => "Bertrand"]);
        return $this->render('animal/custom.html.twig', [
            'animal' => $animal
        ]);
    }

    #[Route('/roadToDQL', name: 'road_to_dql')]
    public function roadToDQL(AnimalRepository $animalRepository) {
//        $animals = $animalRepository->findBy(["specie" => "Licorne"]);
//        $animals = $animalRepository->findBySpecie("Licorne");
        $animals = $animalRepository->findBySpecieAndName("Licorne", "Bertrand");
        dump($animals);
        return $this->render('animal/road-to-dql.html.twig', [
            'animals' => $animals
        ]);
    }
}
