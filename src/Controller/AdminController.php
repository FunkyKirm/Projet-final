<?php


namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController{

    /**
     * @Route("/admin", name="admin_home")
     */
    public function adminHome ()
    {
        return $this->render('admin/admin_base.html.twig');
    }


}