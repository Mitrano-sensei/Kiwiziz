<?php

namespace App\Controller;

use App\Helpers\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChangeProfileController extends AbstractController
{
    #[Route('/change/profile', name: 'app_change_profile')]
    public function index(Security $security): Response
    {
        return $this->render('change_profile/index.html.twig', [
            'username' => $this->getUser()->getUserIdentifier(),
        ]);
    }
}
