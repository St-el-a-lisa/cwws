<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeBlogController extends AbstractController
{
    #[Route('/blog', name: 'app_home_blog')]
    public function index(ArticleRepository $articleRepo, SubjectRepository $subjectrepo): Response
    {
        return $this->render('home_blog/index.html.twig', [
            'articles' => $articleRepo->findAll(),
            'subjects' => $subjectrepo->findAll(),
        ]);
    }
}
