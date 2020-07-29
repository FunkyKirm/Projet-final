<?php


namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController{

    /**
     * @Route("/admin/articles", name="admin_articles")
     */
    public function adminHome ()
    {
        return $this->render('admin/admin_base.html.twig');
    }

    /**
     *@Route("/admin/article/insert" , name="admin_article_insert")
     */
    public function AdminArticleInsert()
    {
        return $this -> redirectToRoute("admin_articles");
    }

    /**
     * @Route("/admin/article/update/{id}" , name="admin_article_update")
     */
    public function AdminBookUpdate ()
    {
        return $this -> redirectToRoute("admin_articles");
    }

    /**
     * @Route("/admin/article/delete/{id}" , name="admin_article_delete")
     */
    public function AdminArticleDelete()
    {
        return $this -> redirectToRoute("admin_articles");
    }

}