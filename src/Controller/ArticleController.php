<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController{

    /**
     * @Route("/articles", name="articles_list")
     */
    public function ArticlesList()
    {
        return $this->render('mountains.html.twig');
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function ArticleShow()
    {
        return $this->render('mountain.html.twig');
    }



}