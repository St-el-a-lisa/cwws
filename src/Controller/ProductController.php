<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Review;
use App\Form\ReviewFormType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    #[Route('/shop/products/{slug}', name: 'product_show', requirements: ['product' => '\d+'])]
    public function show(Product $product, Request $request, EntityManagerInterface $entityManager,  ReviewRepository $reviewRepo): Response

    {

        $reviews = $reviewRepo->findReviews($product);

        $review = new Review();
        $form = $this->createForm(ReviewFormType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $review = $form->getData();

            $user = $this->security->getUser();
            $review->setUser($user);

            $review->setProduct($product);

            $review->setCreatedAt(new  \DateTime());


            $entityManager->persist($review);
            $entityManager->flush();


            $this->addFlash('success', 'Thank You for your rating :)');
            return $this->redirectToRoute('product_show', ['slug' => $product->getSlug()]);
        }

        return $this->render('products/show.html.twig', [
            'product' => $product,
            'reviewForm' => $form->createView(),
            'reviews' => $reviews
        ]);
    }

    #[Route('/products', name: 'app_products')]
    public function index(ProductRepository $productRepo, CategoryRepository $categoryRepo): Response
    {
        // Récupérer uniquement les produits actifs
        $products = $productRepo->findBy(['active' => true]);

        // Récupérer toutes les catégories
        $categories = $categoryRepo->findAll();

        return $this->render('products/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
