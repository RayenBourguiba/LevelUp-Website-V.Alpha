<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\User;
use src\Form\EditEvenementType;
use src\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/events", name="show_events")
     * Method({"GET"})
     */
    public function getEvents()
    {
        $p = $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        return $this->render('/evenement/index.html.twig',
            array('events' => $p));
    }

    /**
     * @Route("/admin_events", name="show_events_admin")
     * Method({"GET"})
     */
    public function getEventsAdmin()
    {
        $p = $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        return $this->render('evenement/afficher_evenements_admin.html.twig',
            array('events' => $p));
    }
    /**
     * @Route("/addevent", name="add_events")
     * Method({"GET","POST"})
     */

    public function AjouterEvenement(Request $request)
    {
        $event = new Evenement();
        $form = $this->createForm(EvenementType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $event->upload();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('show_events_admin');
        }

        return $this->render('evenement/ajouter_evenements_admin.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/deleteevent/{id}", name="delete_event")
     * Method({"GET","POST"})
     */
    public function DeleteEvent($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Evenement::class)->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('show_events_admin');
    }

    /**
     * @Route("/editevent/{id}", name="edit_event")
     * Method({"GET","POST"})
     */
    public function ModifierAction(Request $request, Evenement $event)
    {
        $editForm = $this->createForm(EditEvenementType::class, $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('show_events_admin');
        }

        return $this->render('evenement/modifier_evenements_admin.html.twig', array(
            'event' => $event,
            'form' => $editForm->createView(),
        ));
    }
}
