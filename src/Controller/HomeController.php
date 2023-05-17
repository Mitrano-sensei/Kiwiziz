<?php

namespace App\Controller;

use App\Repository\QuizzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(QuizzRepository $quizzRepository, Security $security): Response
    {
        $quizz = $quizzRepository->findAll();

        return $this->render('home/index.html.twig', [
            'quizz' => $quizz,
            'userConnected' => ($security->getUser() != null) ? true : false,
        ]);
    }
}
