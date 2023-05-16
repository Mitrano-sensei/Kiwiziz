<?php

namespace App\Controller;

use App\Entity\Quizz;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\QuizzRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;

class ListOfQuizzController extends AbstractController
{
    #[Route('/list/of/quizz', name: 'app_list_of_quizz')]
    public function listOfQuizz(QuizzRepository $quizzRepository, Security $security): Response{
        Utils::verifyIfConnected($this, $security);
        
        $allQuizz = $quizzRepository->findAll();
        return $this->render('list_of_quizz/index.html.twig', [
            'allQuizz' => $allQuizz,
        ]);
    }
    

}
