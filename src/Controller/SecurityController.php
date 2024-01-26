<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/profil', name: 'app_profil')]
    public function showprofil(): Response
    {
        return $this->render('security/profil.html.twig');
    }

    #[Route('/charte', name: 'charte')]
    public function charte(){
        return $this->render('security/charte_confidential.html.twig');

    }

    // #[Route(path: '/profil', name: 'app_profil')]
    // public function showprofil(?Security $security = null): Response
    // {if ($security !== null && $security->isGranted('IS_AUTHENTICATED_FULLY')) {
        
    //     $user = $security->getUser();
    //     $lastUsername= $user->getLastUsername();
    //     $email = $user->getEmail();
    //     // ...
    // } else {
    //     //dd($security);
    //     return $this->render("registration/profil.html.twig", 
    //          ['userExist'=> 0] 
    //         );
    // }

       
    //     return $this->render("registration/profil.html.twig", 
    //          [
    //             'username'=> $username,
    //             'email' => $email,
    //             'userExist'=> 1] 
    //          );
    //   }
}