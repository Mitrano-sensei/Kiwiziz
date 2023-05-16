<?php

namespace App\Controller;

use App\Form\QuizFormType;
use App\Form\QuizzFormType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function createQuiz(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger, Security $security): Response
    {
        $form = $this->createForm(QuizzFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('session/session.html.twig', [


        ]);
    }
}
