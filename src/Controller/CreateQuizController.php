<?php

namespace App\Controller;

use App\Form\QuizzFormType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\QuestionRepository;

class CreateQuizController extends AbstractController
{
    #[Route('/create/quiz', name: 'app_create_quiz')]
    public function createQuiz(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $form = $this->createForm(QuizzFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $quiz = $form->getData();
            $quiz->setAuthor($this->getUser());
            $quiz->setCreated(new \DateTime());

            $entityManager->persist($quiz);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('quiz_creation/quiz_creation.html.twig', [
            'controller_name' => 'CreateQuizController',
            'quizForm' => $form->createView()
        ]);
    }
}
