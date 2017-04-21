<?php

namespace AppBundle\Controller;

use AppBundle\Entity\RH;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rh controller.
 *
 */
class RHController extends Controller
{
    /**
     * Lists all rH entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rHs = $em->getRepository('AppBundle:RH')->findAll();

        return $this->render('rh/index.html.twig', array(
            'rHs' => $rHs,
        ));
    }

    /**
     * Creates a new rH entity.
     *
     */
    public function newAction(Request $request)
    {
        $rH = new Rh();
        $form = $this->createForm('AppBundle\Form\RHType', $rH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rH);
            $em->flush($rH);

            return $this->redirectToRoute('rh_show', array('id' => $rH->getId()));
        }

        return $this->render('rh/new.html.twig', array(
            'rH' => $rH,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a rH entity.
     *
     */
    public function showAction(RH $rH)
    {
        $deleteForm = $this->createDeleteForm($rH);

        return $this->render('rh/show.html.twig', array(
            'rH' => $rH,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rH entity.
     *
     */
    public function editAction(Request $request, RH $rH)
    {
        $deleteForm = $this->createDeleteForm($rH);
        $editForm = $this->createForm('AppBundle\Form\RHType', $rH);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rh_edit', array('id' => $rH->getId()));
        }

        return $this->render('rh/edit.html.twig', array(
            'rH' => $rH,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rH entity.
     *
     */
    public function deleteAction(Request $request, RH $rH)
    {
        $form = $this->createDeleteForm($rH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rH);
            $em->flush($rH);
        }

        return $this->redirectToRoute('rh_index');
    }

    /**
     * Creates a form to delete a rH entity.
     *
     * @param RH $rH The rH entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RH $rH)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rh_delete', array('id' => $rH->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
