<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/article/{slug}', name: 'article_show')]
    public function show(?Article $article, Request $request, EntityManagerInterface $entityManager, CommentRepository $commentRepo): Response
    {
        if (!$article) {
            return $this->redirectToRoute('app_home');
        }

        $comments = $commentRepo->findComs($article);

        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $user = $this->security->getUser();
            $comment->setAuthor($user);

            $comment->setArticle($article);

            $comment->setCreatedAt(new  \DateTime());


            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Your comment has been successfully submitted and is awaiting approval');
            return $this->redirectToRoute('article_show', ['slug' => $article->getSlug()]);
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView(),
            'comments' => $comments

        ]);
    }
}
