<?php


namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\MountainsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController{

    /**
     * @Route("/", name="home")
     */
    public function home(
        MountainsRepository $mountainsRepository,
        ArticlesRepository $articlesRepository
        )
        {
            $mountains = $mountainsRepository->findBy([], ['id'=> 'DESC'],3);
            $articles = $articlesRepository->findBy([], ['id'=>'DESC'], 3);

            return $this->render('home.html.twig', [
                "mountains" => $mountains,
                "articles" => $articles
            ]);
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