<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Entity\Program;



class ProgramController extends AbstractController
{
    #[Route('/program', name: 'program_index')]
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
    //#[Route('/show/{id<^[0-9]+$>}', name: 'show')]

    public function show(int $id, ProgramRepository $programRepository):Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        // same as $program = $programRepository->find($id);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
}
    //public function show(int $id): Response
    //{
        // Vous pouvez utiliser $id comme vous le souhaitez, par exemple, le passer à la vue.
        //return $this->render('program/show.html.twig', [
       //     'id' => $id,
        //]);

    

}
