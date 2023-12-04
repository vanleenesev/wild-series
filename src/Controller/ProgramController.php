<?php

namespace App\Controller;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        // Récupérer toutes les séries depuis le repository
        $programs = $programRepository->findAll();

        // Passer les séries à la vue pour l'affichage
        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

    #[Route('/show/{id}/',methods:['GET'], requirements: ['id'=>'\d+'], name: 'show')]
    public function show(int $id): Response
    {
        // Vous pouvez utiliser $id comme vous le souhaitez, par exemple, le passer à la vue.
        return $this->render('program/show.html.twig', [
            'id' => $id,
        ]);

    }
}
