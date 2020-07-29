<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MountainController extends AbstractController{

    /**
     * @Route("/mountains", name="mountains_list")
     */
    public function MountainsList()
    {
        return $this->render('mountains.html.twig');
    }

    /**
     * @Route("/mountain/{id}", name="mountain_show")
     */
    public function MountainShow()
    {
        return $this->render('mountain.html.twig');
    }

}