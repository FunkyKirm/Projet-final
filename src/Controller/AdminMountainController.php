<?php


namespace App\Controller;

use App\Entity\Mountains;
use App\Form\MountainType;
use App\Repository\MountainsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminMountainController extends AbstractController{

    /**
     * @Route("/admin/mountains", name="admin_mountains")
     */
    public function adminMountains (MountainsRepository $mountainsRepository)
    {
        $mountains = $mountainsRepository ->findAll();
        return $this->render('admin/admin_mountains.html.twig',
        [
            "mountains" => $mountains
        ]);
    }

                    # INSERT MOUNTAIN #
    /**
     * @Route("/admin/mountain/insert" , name="admin_mountain_insert")
     */
    public function AdminMountainInsert
    (
        EntityManagerInterface $entityManager,
        Request $request,
        SluggerInterface $slugger
    )
    {
        $mountain = new Mountains();

        $mountainForm = $this->createForm(MountainType::class, $mountain);

        $mountainForm -> handleRequest($request);

        if($mountainForm -> isSubmitted() && $mountainForm -> isValid()){

            $mountainCoverFile = $mountainForm->get('mountainCover')->getData();
            if ($mountainCoverFile){

                $originalCoverName = pathinfo($mountainCoverFile->getClientOriginalName(),PATHINFO_FILENAME);

                $safeCoverName = $slugger->slug($originalCoverName);
                $uniqueCoverName = $safeCoverName . '-' . uniqid() . '-' . $mountainCoverFile->guessExtension();


                #mountain_cover_directory est parametré dans le dossier config/service.yaml
                try {
                    $mountainCoverFile->move(
                        $this->getParameter('mountain_cover_directory'),
                        $uniqueCoverName
                    );
                } catch (FileException $e){
                    return new Response($e->getMessage());
                }
                $mountain->setMountainCover($uniqueCoverName);
            }

            $entityManager->persist($mountain);
            $entityManager->flush();

            $this->addFlash('success', 'Votre montagne a été créé !');
            return $this -> redirectToRoute("admin_mountains");
        }

        return $this -> render("admin/admin_mountain_insert.html.twig", [
            "mountainForm" => $mountainForm -> createView()
        ]);
    }






                    # UPDATE MOUNTAIN #
    /**
     * @Route("/admin/mountain/update/{id}" , name="admin_mountain_update")
     */
    public function AdminMountainUpdate (
        MountainsRepository $mountainsRepository,
        EntityManagerInterface $entityManager,
        Request $request,
        SluggerInterface $slugger,
        $id
    )
    {
        $mountain = $mountainsRepository -> find($id);

        $mountainForm =$this->createForm(MountainType::class, $mountain);

        $mountainForm -> handleRequest($request);

        if($mountainForm -> isSubmitted() && $mountainForm -> isValid()){

            $mountainCoverFile = $mountainForm->get('mountainCover')->getData();
            if ($mountainCoverFile){

                $originalCoverName = pathinfo($mountainCoverFile->getClientOriginalName(),PATHINFO_FILENAME);

                $safeCoverName = $slugger->slug($originalCoverName);
                $uniqueCoverName = $safeCoverName . '-' . uniqid() . '-' . $mountainCoverFile->guessExtension();


                #mountain_cover_directory est parametré dans le dossier config/service.yaml
                try {
                    $mountainCoverFile->move(
                        $this->getParameter('mountain_cover_directory'),
                        $uniqueCoverName
                    );
                } catch (FileException $e){
                    return new Response($e->getMessage());
                }
                $mountain->setMountainCover($uniqueCoverName);
            }

            $entityManager->persist($mountain);
            $entityManager->flush();

            $this->addFlash('success', 'Votre montagne a été modifié !');
            return $this -> redirectToRoute("admin_mountains");
        }

        return $this->render('admin/admin_mountain_update.html.twig', [
            'mountainForm' => $mountainForm->createView()
        ]);
    }

    /**
     * @Route("/admin/mountain/delete/{id}" , name="admin_mountain_delete")
     */
    public function AdminMountainDelete(
        MountainsRepository $mountainsRepository,
        EntityManagerInterface $entityManager,
        $id
    )
    {
        $mountain = $mountainsRepository->find($id);

        $entityManager -> remove($mountain);
        $entityManager -> flush();

        $this->addFlash('success', 'Votre montagne a bien été supprimé !');
        return $this -> redirectToRoute("admin_mountains");
    }
}