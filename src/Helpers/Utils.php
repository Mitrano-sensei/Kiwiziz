<?php

namespace App\Helpers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;

class Utils {
    public static function verifyIfConnected(AbstractController $controller, Security $security)
    {
        $connected = $security->isGranted('IS_AUTHENTICATED_FULLY');

        if (!$connected)
        {
            return $controller->redirectToRoute('app_login');
        }
    }
}