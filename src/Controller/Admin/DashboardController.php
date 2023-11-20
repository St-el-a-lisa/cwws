<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Review;
use App\Entity\Subject;
use App\Entity\User;
use App\Entity\Menu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {}


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator 
            ->setController(ProductCrudController::class)
            ->generateUrl();
        
        return $this ->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ventalis Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Go sur le site!', 'fa fa-undo', 'app_home');

        yield MenuItem::section('Ecommerce','fas fa-store');
        yield MenuItem::section('Produits');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter un produit', 'fas fa-plus', Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Tous les produits', 'fas fa-store', Product::class),
            MenuItem::linkToCrud('Avis', 'fas fa-comment', Review::class),
        ]);

        yield MenuItem::section('Categories');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter une categorie', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Toutes les categories', 'fas fa-store', Category::class),
        ]);



        yield MenuItem::section('Blog', 'fas fa-newspaper');

        yield MenuItem::subMenu('Articles', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add +', 'fas fa-pen-nib', Article::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('All articles', 'fas fa-newspaper', Article::class),
        ]);

        yield MenuItem::subMenu('Subjects', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add +', 'fas fa-pen-nib', Subject::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Subjects list', 'fas fa-list', Subject::class),
        ]);

        yield MenuItem::section('Navigation', 'fas fa-route');


        yield MenuItem::subMenu('Menus', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Pages', 'fas fa-file', Menu::class)
            ->setQueryParameter('submenuIndex',0),
            MenuItem::linkToCrud('Articles', 'fas fa-newspaper', Menu::class)
            ->setQueryParameter('submenuIndex',1),
            MenuItem::linkToCrud('Liens personnalisés', 'fas fa-link', Menu::class)
            ->setQueryParameter('submenuIndex',2),
            MenuItem::linkToCrud('Sujets', 'fab fa-delicious', Menu::class)
            ->setQueryParameter('submenuIndex',3),

        ]);

        yield MenuItem::section('Admin','fas fa-newspaper');
        yield MenuItem::section('Users');

        yield MenuItem::subMenu('Articles', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add +', 'fas fa-pen-nib', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('All articles', 'fas fa-newspaper', User::class),
               
        ]);
    }
}
