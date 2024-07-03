<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\SubjectRepository;
use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepo, ArticleRepository $articleRepo, SubjectRepository $subjectrepo): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepo->findAll(),
            'subjects' => $subjectrepo->findAll(),
            'products' => $productRepo->findAll(),

        ]);
    }
}
