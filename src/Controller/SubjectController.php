<?php

namespace App\Controller;

use App\Entity\Subject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubjectController extends AbstractController
{
    #[Route('/blog/subject/{slug}', name: 'subject_show')]
    public function show(?Subject $subject): Response
    {
        if (!$subject) {
            return $this->redirectToRoute('app_home_blog');
        }
        return $this->render('subject/show.html.twig', [
            'subject' => $subject,
        ]);
    }
}
