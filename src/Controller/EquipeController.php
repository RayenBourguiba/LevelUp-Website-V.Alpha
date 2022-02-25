<?php

namespace App\Controller;

use App\Entity\Equipe;
use src\Form\EditEquipeType;
use src\Form\EquipeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EquipeController extends AbstractController
{

    /**
     * @Route("/equipes", name="get_equipes")
     * Method({"GET"})
     */
    public function getEquipes()
    {
        $p = $this->getDoctrine()->getRepository(Equipe::class)->findAll();
        return $this->render('equipe/index.html.twig',
            array('equipes' => $p));
    }

    /**
     * @Route("/admin_equipes", name="show_equipes_admin")
     * Method({"GET"})
     */
    public function getEquipesAdmin()
    {
        $p = $this->getDoctrine()->getRepository(Equipe::class)->findAll();
        return $this->render('equipe/afficher_equipe_admin.html.twig',
            array('equipes' => $p));
    }
    /**
     * @Route("/addequipe", name="add_equipe")
     * Method({"GET","POST"})
     */

    public function ajouterEquipe(Request $request)
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $equipe->upload();
            $em->persist($equipe);
            $em->flush();
            return $this->redirectToRoute('show_equipes_admin');
        }

        return $this->render('equipe/ajouter_equipe.html.twig', array(
            'equipe' => $equipe,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/deleteequipe/{id}", name="delete_equipe")
     * Method({"GET","POST"})
     */
    public function DeleteEquipe($id)
    {
        $em = $this->getDoctrine()->getManager();
        $equipe = $em->getRepository(Equipe::class)->find($id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('show_equipes_admin');
    }

    /**
     * @Route("/editequipe/{id}", name="edit_equipe")
     * Method({"GET","POST"})
     */
    public function ModifierEquipe(Request $request, Equipe $equipe)
    {
        $editForm = $this->createForm(EditEquipeType::class, $equipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('show_equipes_admin');
        }

        return $this->render('equipe/modifier_equipe.html.twig', array(
            'equipe' => $equipe,
            'form' => $editForm->createView(),
        ));
    }
}
