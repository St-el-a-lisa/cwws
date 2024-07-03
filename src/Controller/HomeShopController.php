<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\SubjectRepository;
use App\Repository\ArticleRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeShopController extends AbstractController
{
    #[Route('/konbini', name: 'app_shop')]
    public function index(ProductRepository $productRepo, CategoryRepository $categoryRepo, SubjectRepository $subjectrepo, ArticleRepository $articleRepo): Response
    {
        return $this->render('home_shop/index.html.twig', [
            'products' => $productRepo->findAll(),
            'categories' => $categoryRepo->findAll(),
            'subjects' => $subjectrepo->findAll(),
            'articles' => $articleRepo->findAll(),


        ]);
    }
}
