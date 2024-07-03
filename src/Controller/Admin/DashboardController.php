<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\Review;
use App\Entity\Subject;
use App\Entity\User;
use App\Entity\Menu;
use App\Entity\Rewiew;
use App\Entity\Stock;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Proxies\__CG__\App\Entity\Review as EntityReview;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ProductCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CwWS BACK');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Check Out CwWS', 'fa fa-undo', 'app_home');




        yield MenuItem::section('Blog', 'fas fa-newspaper');

        yield MenuItem::subMenu('Articles', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add +', 'fas fa-pen-nib', Article::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('All articles', 'fas fa-newspaper', Article::class),
        ]);

        yield MenuItem::subMenu('Subjects', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add +', 'fas fa-pen-nib', Subject::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Subjects list', 'fas fa-list', Subject::class),
        ]);

        yield MenuItem::subMenu('Comments', 'fas fa-bars')->setSubItems([
            // MenuItem::linkToCrud('Gestion', 'fas fa-comment', Comment::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Comments list', 'fas fa-comments', Comment::class),
        ]);
        yield MenuItem::section('Blog Navigation', 'fas fa-route');


        yield MenuItem::subMenu('Menus', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Pages', 'fas fa-file', Menu::class)
                ->setQueryParameter('submenuIndex', 0),
            MenuItem::linkToCrud('Articles', 'fas fa-newspaper', Menu::class)
                ->setQueryParameter('submenuIndex', 1),
            MenuItem::linkToCrud('Custom Links', 'fas fa-link', Menu::class)
                ->setQueryParameter('submenuIndex', 2),
            MenuItem::linkToCrud('Sujets', 'fab fa-delicious', Menu::class)
                ->setQueryParameter('submenuIndex', 3),

        ]);

        yield MenuItem::section('Ecommerce', 'fas fa-store');

        yield MenuItem::subMenu('Products', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add +', 'fas fa-plus', Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('All Products', 'fas fa-store', Product::class),
            MenuItem::linkToCrud('Ratings', 'fas fa-star', Review::class),
        ]);



        yield MenuItem::subMenu('Stocks', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add +', 'fas fa-plus', Stock::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('All Stock', 'fas fa-store', Stock::class),
        ]);


        yield MenuItem::subMenu('Categories', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add +', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Categories List', 'fas fa-store', Category::class),
        ]);



        if ($this->isGranted('ROLE_ADMIN')) {

            yield MenuItem::section('Admin', 'fas fa-newspaper');


            yield MenuItem::subMenu('Crew', 'fas fa-bars')->setSubItems([
                MenuItem::linkToCrud('Add +', 'fas fa-pen-nib', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('All Crew', 'fas fa-users', User::class),

            ]);
        }
    }
}
