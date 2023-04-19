<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignInType;
use App\Form\SignUpType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        if (!$this->getUser()) 
        {
            $form1 = $this->createForm(SignInType::class,null);
            $form2 = $this->createForm(SignUpType::class,null);

            return $this->render('index.html.twig', ['sign_in_form' => $form1, 'sign_up_form' => $form2]);
        }
        
        return $this->render('index.html.twig');
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function dashboard(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('index');
        }
        
        return $this->render('dashboard.html.twig');
    }

    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('index');
        }

        return $this->render('profile.html.twig');
    }
}
