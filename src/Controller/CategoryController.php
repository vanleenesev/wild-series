<?php
namespace App\Controller;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
      #[Route("/category", name:"category_index")]
     
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        // Votre logique pour afficher la liste des catégories
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }


    #[Route("/category/{id}", name:"category_show", requirements: ['id'=>'\d+'])]
     
    public function show(CategoryRepository $categoryRepository, ProgramRepository $programRepository, string $categoryName): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);
        // Vérifier si la catégorie existe
        if (!$category) {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        // Récupérer toutes les séries de la catégorie, au maximum 3, ordonnées par ID décroissant
        $programs = $programRepository->findBy(
            ['category' => $category],
            ['id' => 'DESC'],
            3 // Limite à 3 séries
        );

        // Votre logique pour afficher les détails de la catégorie avec l'id spécifié
        return $this->render('category/show.html.twig', [
        'category' => $category,
        'programs' => $programs,
    ]);
    }
}
