<?php

namespace App\Controller;

use App\Repository\QuizzRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    #[Route('/quiz', name: 'app_quiz')]
    public function index(Security $security): Response
    {
        return $this->render('quiz/quiz.html.twig', [
            'controller_name' => 'QuizController',
            'userConnected' => ($security->getUser() != null) ? true : false,
        ]);
    }

    #[Route('/delete/quiz/{id}', name: 'app_quiz_delete')]
    public function deleteQuiz($id, EntityManagerInterface $entityManager, QuizzRepository $quizzRepository) : Response
    {
        $quizz = $quizzRepository->find($id);
        $entityManager->remove($quizz);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}
