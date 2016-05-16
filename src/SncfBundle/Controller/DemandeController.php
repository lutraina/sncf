<?php

namespace SncfBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SncfBundle\Entity\Demande;
use SncfBundle\Form\DemandeType;

/**
 * Demande controller.
 *
 * @Route("/demandes")
 */
class DemandeController extends Controller
{
    /**
     * Lists all Demande entities.
     *
     * @Route("/", name="demandes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $demandes = $em->getRepository('SncfBundle:Demande')->findAll();

        return $this->render('demande/index.html.twig', array(
            'demandes' => $demandes,
        ));
    }

    /**
     * Creates a new Demande entity.
     *
     * @Route("/new", name="demandes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $demande = new Demande();
        $form = $this->createForm('SncfBundle\Form\DemandeType', $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demande);
            $em->flush();

            return $this->redirectToRoute('demandes_show', array('id' => $demande->getId()));
        }

        return $this->render('demande/new.html.twig', array(
            'demande' => $demande,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Demande entity.
     *
     * @Route("/{id}", name="demandes_show")
     * @Method("GET")
     */
    public function showAction(Demande $demande)
    {
        $deleteForm = $this->createDeleteForm($demande);

        return $this->render('demande/show.html.twig', array(
            'demande' => $demande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Demande entity.
     *
     * @Route("/{id}/edit", name="demandes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Demande $demande)
    {
        $deleteForm = $this->createDeleteForm($demande);
        $editForm = $this->createForm('SncfBundle\Form\DemandeType', $demande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demande);
            $em->flush();

            return $this->redirectToRoute('demandes_edit', array('id' => $demande->getId()));
        }

        return $this->render('demande/edit.html.twig', array(
            'demande' => $demande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Demande entity.
     *
     * @Route("/{id}", name="demandes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Demande $demande)
    {
        $form = $this->createDeleteForm($demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demande);
            $em->flush();
        }

        return $this->redirectToRoute('demandes_index');
    }

    /**
     * Creates a form to delete a Demande entity.
     *
     * @param Demande $demande The Demande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Demande $demande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demandes_delete', array('id' => $demande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
