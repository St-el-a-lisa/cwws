<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Review;
use App\Form\ReviewFormType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/shop/products/{slug}', name: 'product_show', requirements: ['product' => '\d+'])]
    public function show(Product $product): Response

    {
        $review = new Review($product);

        $reviewForm = $this->createForm(ReviewFormType::class, $review);

        return $this->render('products/show.html.twig', [
            'product' => $product,
            'reviewForm' => $reviewForm,
        ]);
    }

    #[Route('/products', name: 'app_products')]
    public function index(ProductRepository $productRepo, CategoryRepository $categoryRepo): Response
    {
        return $this->render('products/index.html.twig', [
            'products' => $productRepo->findAll(),
            'categories' => $categoryRepo->findAll(),



        ]);
    }
}
