<?php

namespace App\Controller;

use App\Form\QuizFormType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateQuizController extends AbstractController
{
    #[Route('/create/quiz', name: 'app_create_quiz')]
    public function createQuiz(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $form = $this->createForm(QuizFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $quiz = $form->getData();
            $quiz->setCreator($this->getUser());

            $entityManager->persist($quiz);
            $entityManager->flush();

            $logger->info('Quiz created by ' . $this->getUser()->getUsername());
            $logger->info('Quiz theme: ' . $quiz->getTheme() . ', date: ' . $quiz->getDate()->format('Y-m-d H:i:s') . ', id: ' . $quiz->getId() . ', creator: ' . $quiz->getCreator()->getUsername() . '.');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('quiz_creation/quiz_creation.html.twig', [
            'controller_name' => 'CreateQuizController',
            'quizForm' => $form->createView()
        ]);
    }
}
