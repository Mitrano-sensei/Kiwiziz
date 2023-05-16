<?php

namespace App\Controller;

use App\Entity\Quiz;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\QuizRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ListOfQuizzController extends AbstractController
{
    #[Route('/list/of/quizz', name: 'app_list_of_quizz')]
    // public function index(): Response
    // {
    //     return $this->render('list_of_quizz/index.html.twig', [
    //         'controller_name' => 'ListOfQuizzController',
    //     ]);
    // }
    public function listOfQuizz(QuizRepository $quizzRepository): Response{
        $allQuizz = $quizzRepository->findAll();
        return $this->render('list_of_quizz/index.html.twig', [
            'allQuizz' => $allQuizz,
        ]);
    }
    

}
