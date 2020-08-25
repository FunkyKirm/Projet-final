<?php


namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController{

    /**
     * @Route("/articles", name="articles_list")
     */
    public function ArticlesList(
        ArticlesRepository $articlesRepository
    )
    {
        $articles = $articlesRepository->findBy([], ['id'=> 'DESC']);

        return $this->render('articles.html.twig', [
            "articles" => $articles,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function ArticleShow()
    {
        return $this->render('mountain.html.twig');
    }



}