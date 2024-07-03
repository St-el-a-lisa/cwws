<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartRepository $cartRepo): Response
    {
        $customer = $this->getUser();

        if (!$customer) {
            return $this->redirectToRoute('app_login');
        }

        $cart = $cartRepo->findOneBy(['customer' => $customer]);

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }



    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function addToCart(Product $product, Request $request, CartRepository $cartRepo): Response
    {
        $customer = $this->getUser();

        if (!$customer) {
            return $this->redirectToRoute('app_login');
        }

        $cart = $cartRepo->findOneBy(['customer' => $customer]);

        if (!$cart) {
            $cart = new Cart();
            $cart->setCustomer($customer);
        }
    }
}
