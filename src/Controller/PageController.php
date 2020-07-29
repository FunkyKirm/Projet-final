<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController{

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('about.html.twig');
    }

    /**
     * @Route("/search", name="search")
     */
    public function search()
    {
        return $this->render('search.html.twig');
    }

}