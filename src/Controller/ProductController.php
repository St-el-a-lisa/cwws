<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Review;
use App\Form\ReviewFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/shop/product/{slug}', name: 'product_show')]
    public function show(Product $product): Response

    {
        $review = new Review($product); 

        $reviewForm = $this -> createForm(ReviewFormType::class, $review); 

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'reviewForm'=> $reviewForm, 
        ]);
    }

    // #[Route('/product', name: 'app_product')]
    // public function index(): Response
    // {
    //     return $this->render('product/index.html.twig', [
    //         'controller_name' => 'ProductController',
    //     ]);
    // }
}



