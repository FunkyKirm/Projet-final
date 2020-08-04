<?php


namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\MountainsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController{

    /**
     * @Route("/admin/home", name="admin_home")
     */
    public function adminHome (MountainsRepository $mountainsRepository, ArticlesRepository $articlesRepository)
    {
        $mountains = $mountainsRepository->findBy([], ['id'=> 'DESC'],3);
        $articles = $articlesRepository->findBy([], ['id'=>'DESC'], 3);

        return $this->render('admin/admin_base.html.twig', [
            "mountains" => $mountains,
            "articles" => $articles
            ]);
    }


}