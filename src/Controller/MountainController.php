<?php


namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\MountainsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MountainController extends AbstractController{

    /**
     * @Route("/mountains", name="mountains_list")
     */
    public function MountainsList(
        MountainsRepository $mountainsRepository
    )
    {
        $mountains = $mountainsRepository->findBy([], ['id'=> 'DESC']);

        return $this->render('mountains.html.twig', [
            "mountains" => $mountains,
        ]);
    }

    /**
     * @Route("/mountain/{id}", name="mountain_show")
     */
    public function MountainShow()
    {
        return $this->render('mountain.html.twig');
    }

}