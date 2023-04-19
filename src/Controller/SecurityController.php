<?php

namespace App\Controller;

use App\Security\UserVerification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    public function __construct(private UserVerification $uv)
    {   
    }
    /*#[Route(path: '/index', name: 'index_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        dd("ok");
        if ($this->getUser()) {
             return $this->redirectToRoute('dashboard');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('index.html.twig');
        //return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }*/

    #[Route('/verify/{token}', name: 'verify')]
    public function index($token): Response
    {
        $this->uv->verify($token);
        
        return $this->redirectToRoute('index');
    }


    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
