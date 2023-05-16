<?php

namespace App\Controller;

use App\Form\ChangePasswordFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\HttpFoundation\Request;

class ChangePasswordController extends AbstractController
{
    #[Route('/change/password', name: 'app_change_password')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            if (!$userPasswordHasher->isPasswordValid($this->getUser(), $form->get('oldPassword')->getData())) {
                $this->addFlash('error', 'The old password is incorrect.');
                return $this->redirectToRoute('app_change_password');
            }

            if ($form->get('newPassword')->getData() == $form->get('oldPassword')->getData()) {
                $this->addFlash('error', 'The new password must be different from the old one.');
                return $this->redirectToRoute('app_change_password');
            }

            $user = $this->getUser()->setPassword(
                $userPasswordHasher->hashPassword(
                    $this->getUser(),
                    $form->get('newPassword')->getData()
                )
            );

            // Make user persist in database
            $entityManager->persist($user);
            $entityManager->flush();

        }

        return $this->render('change_password/index.html.twig', [
            'controller_name' => 'ChangeProfileController',
            'changePasswordForm' => $form->createView(),
        ]);

    }
}