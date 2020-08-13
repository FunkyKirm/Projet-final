<?php


namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticleType;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminArticleController extends AbstractController
{

    /**
     * @Route("/admin/articles", name="admin_articles")
     */
    public function adminArticles(ArticlesRepository $articlesRepository)
    {
        $articles = $articlesRepository->findAll();
        return $this->render('admin/admin_articles.html.twig',
            [
                'articles' => $articles
            ]);
    }

    /**
     * @Route("/admin/article/insert" , name="admin_article_insert")
     */
    public function AdminArticleInsert(
        EntityManagerInterface $entityManager,
        Request $request,
        SluggerInterface $slugger
    )
    {
        $article = new Articles();

        $articleForm = $this->createForm(ArticleType::class, $article);

        $articleForm ->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()){
            $articleCoverFile = $articleForm->get('articleCover')->getData();
            if($articleCoverFile){

                $originalCoverName = pathinfo($articleCoverFile->getClientOriginalName(),PATHINFO_FILENAME);
                $safeCoverName = $slugger->slug($originalCoverName);
                $uniqueCoverName = $safeCoverName . '-' . uniqid() . '-' . $articleCoverFile->guessExtension();

                try {
                    $articleCoverFile->move(
                        $this->getParameter('article_cover_directory'),
                        $uniqueCoverName
                    );
                } catch (FileException $e){
                    return new Response($e->getMessage());
                }
                $article->setArticleCover($uniqueCoverName);
            }

            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'Votre article a été créé !');
            return $this->redirectToRoute("admin_articles");
        }
        return $this->render("admin/admin_article_insert.html.twig",
        [
            'articleForm' => $articleForm -> createView()
        ]);
    }

    # UPDATE article #
    /**
     * @Route("/admin/article/update/{id}" , name="admin_article_update")
     */
    public function AdminArticleUpdate (
        ArticlesRepository $articlesRepository,
        EntityManagerInterface $entityManager,
        Request $request,
        SluggerInterface $slugger,
        $id
    )
    {
        $article = $articlesRepository -> find($id);

        $articleForm =$this->createForm(articleType::class, $article);

        $articleForm -> handleRequest($request);

        if($articleForm -> isSubmitted() && $articleForm -> isValid()){

            $articleCoverFile = $articleForm->get('articleCover')->getData();
            if ($articleCoverFile){

                $originalCoverName = pathinfo($articleCoverFile->getClientOriginalName(),PATHINFO_FILENAME);

                $safeCoverName = $slugger->slug($originalCoverName);
                $uniqueCoverName = $safeCoverName . '-' . uniqid() . '-' . $articleCoverFile->guessExtension();


                #article_cover_directory est parametré dans le dossier config/service.yaml
                try {
                    $articleCoverFile->move(
                        $this->getParameter('article_cover_directory'),
                        $uniqueCoverName
                    );
                } catch (FileException $e){
                    return new Response($e->getMessage());
                }
                $article->setarticleCover($uniqueCoverName);
            }

            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'Votre article a été modifié !');
            return $this -> redirectToRoute("admin_articles");
        }

        return $this->render('admin/admin_article_update.html.twig', [
            'articleForm' => $articleForm->createView()
        ]);
    }


    /**
     * @Route("/admin/article/delete/{id}" , name="admin_article_delete")
     */
    public function AdminArticleDelete(
        ArticlesRepository $articlesRepository,
        EntityManagerInterface $entityManager,
        $id
    )
    {
        $article = $articlesRepository->find($id);

        $entityManager -> remove($article);
        $entityManager -> flush();

        $this->addFlash('success', 'Votre article a bien été supprimé !');
        return $this -> redirectToRoute("admin_articles");
    }
}