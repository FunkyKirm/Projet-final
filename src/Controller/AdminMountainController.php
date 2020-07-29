<?php


namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminMountainController extends AbstractController{

    /**
     * @Route("/admin/mountains", name="admin_mountains")
     */
    public function adminHome ()
    {
        return $this->render('admin/admin_base.html.twig');
    }

    /**
     * @Route("/admin/mountain/insert" , name="admin_mountain_insert")
     */
    public function AdminMountainInsert()
    {
        return $this -> redirectToRoute("admin_mountains");
    }

    /**
     * @Route("/admin/mountain/update/{id}" , name="admin_mountain_update")
     */
    public function AdminMountainUpdate ()
    {
        return $this -> redirectToRoute("admin_mountains");
    }

    /**
     * @Route("/admin/mountain/delete/{id}" , name="admin_mountain_delete")
     */
    public function AdminMountainDelete()
    {
        return $this -> redirectToRoute("admin_mountains");
    }


}