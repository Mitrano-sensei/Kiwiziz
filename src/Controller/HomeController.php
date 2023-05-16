<?php

namespace App\Controller;

use App\Helpers\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
<<<<<<< Updated upstream
    public function index(Security $security): Response
=======
    public function index(): Response
>>>>>>> Stashed changes
    {
        Utils::verifyIfConnected($this, $security);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
