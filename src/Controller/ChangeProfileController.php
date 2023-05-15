<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChangeProfileController extends AbstractController
{
    #[Route('/change/profile', name: 'app_change_profile')]
    public function index(): Response
    {
        return $this->render('change_profile/index.html.twig', [
            'username' => $this->getUser()->getUserIdentifier(),
        ]);
    }
}
