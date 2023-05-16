<?php

namespace App\Controller;

use App\Form\QuizFormType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_create_quiz')]
    public function createQuiz(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $form = $this->createForm(QuizFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
            'quizForm' => $form->createView()
        ]);
    }
}
