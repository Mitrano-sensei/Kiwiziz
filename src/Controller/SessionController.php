<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\SessionQuestion;
use App\Repository\QuizzRepository;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session/{id}/{questionNb}', name: 'app_session', methods: ['GET', 'HEAD'])]
    public function createQuiz($id, $questionNb, Request $request, EntityManagerInterface $entityManager, Security $security, SessionRepository $sessionRepository): Response
    {
        $session = $sessionRepository->findOneBy(['id' => $id]);

        $quiz = $session->getQuizz();
        $question = $quiz->getQuestions()[$questionNb];

        if ($question == null)
            dd("Finished");

        return $this->render('session/session.html.twig', [
            'quizTitle' => $quiz->getTitle(),
            'questionTitle' => $question->getText(),
            'questionType' => $question->getType()->getLabel(),
            'answers' => $question->getAnswers(),
            'sessionId' => $id,
            'questionNb' => $questionNb,
        ]);
    }

    #[Route('/session/{id}/{questionNb}', name: 'app_session_post', methods: ['POST'])]
    public function formValidation($id, $questionNb, Request $request, SessionRepository $sessionRepository, EntityManagerInterface $entityManager): Response
    {
        $session = $sessionRepository->findOneBy(['id' => $id]);
        $question = $session->getQuizz()->getQuestions()[$questionNb];
        $playerAnswer = $question->getAnswers()[$request->request->get('answer') - 1];

        $nextQuestion = $session->getQuizz()->getQuestions()[$questionNb + 1];
        if ($nextQuestion == null) {
            $date = new \DateTime();
            $date->setTimestamp(time());
            $session->setFinished($date);

            dd("FINISHED");
            $entityManager->persist($session);
            $entityManager->flush();
        }

        $sessionQuestion = new SessionQuestion();
        $sessionQuestion->setSession($session);
        $sessionQuestion->setQuestion($question);
        $sessionQuestion->addAnswer($playerAnswer);

        $entityManager->persist($sessionQuestion);
        $entityManager->flush();

        return $this->redirectToRoute('app_session', ['id' => $id, 'questionNb' => $questionNb + 1]);
    }

    #[Route('/create/session/{quizId}', name: 'app_create_session', methods: ['GET'])]
    public function createSession($quizId, Request $request, Security $security, QuizzRepository $quizzRepository, EntityManagerInterface $entityManager): Response
    {
        $quiz = $quizzRepository->findOneBy(['id' => $quizId]);
        $session = new Session();
        $session->setQuizz($quiz);
        $session->setUser($security->getUser());
        $session->setStarted(new \DateTime());
        $session->setQuestionCount($quiz->getQuestions()->count());
        $session->setAnswerCorrect(0);

        $entityManager->persist($session);
        $entityManager->flush();

        return $this->redirectToRoute('app_session', ['id' => $session->getId(), 'questionNb' => 0]);
    }
}