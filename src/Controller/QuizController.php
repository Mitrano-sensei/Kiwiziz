<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\QuestionType;
use App\Entity\Quizz;
use App\Repository\QuizzRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    #[Route('/create/quiz', name: 'app_create_quiz')]
    public function index(Security $security, EntityManagerInterface $entityManager): Response
    {
        $quiz = new Quizz();
        $quiz->setAuthor($security->getUser());
        $quiz->setTitle("Mon nouveau Quiz ! :)");
        $quiz->setCreated(new \DateTime());

        $answer1 = new Answer();
        $answer1->setText("Réponse 1");
        $answer1->setCorrect(true);
        $answer2 = new Answer();
        $answer2->setText("Réponse 2");
        $answer2->setCorrect(false);

        $question = new Question();
        $question->setText("Ma question");
        $question->addAnswer($answer1);
        $question->addAnswer($answer2);

        $questionType = new QuestionType();
        $questionType->setLabel('list');
        $question->setType($questionType);

        $quiz->addQuestion($question);


        $questions = $quiz->getQuestions();

        $entityManager->persist($questionType);
        $entityManager->persist($quiz);
        $entityManager->persist($question);
        $entityManager->persist($answer1);
        $entityManager->persist($answer2);
        $entityManager->flush();

        $questions = $questions->map(function ($question) {
            $answers = $question->getAnswers();
            $answers = $answers->map(function ($answer) {
                return [
                    'id' => $answer->getId(),
                    'title' => $answer->getText(),
                    'correct' => $answer->isCorrect(),
                ];
            });
            return [
                'id' => $question->getId(),
                'title' => $question->getText(),
                'type' => $question->getType()->getLabel(),
                'image' => $question->getImage(),
                'answers' => $answers,
            ];
        });

        //dd($questions);

        return $this->render('quiz/quiz.html.twig', [
            'controller_name' => 'QuizController',
            'userConnected' => ($security->getUser() != null) ? true : false,
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }

    #[Route('/delete/quiz/{id}', name: 'app_quiz_delete')]
    public function deleteQuiz($id, EntityManagerInterface $entityManager, QuizzRepository $quizzRepository): Response
    {
        $quizz = $quizzRepository->find($id);
        $entityManager->remove($quizz);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }

    #[Route('/save/quiz', name: 'app_created_quiz', methods: ['POST', 'GET'])]
    public function createdQuiz(Request $request, QuizzRepository $quizzRepository) : Response
    {
        $postRequest = $request->request;

        $quizTitle = $postRequest->get('quizzTitle');
        $quiz = $quizzRepository->findOneBy(['title' => $quizTitle]);
    }
}