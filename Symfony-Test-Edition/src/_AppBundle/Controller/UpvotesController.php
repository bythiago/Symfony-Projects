<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Upvotes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Upvote controller.
 *
 * @Route("upvotes")
 */
class UpvotesController extends Controller
{
    /**
     * Lists all upvote entities.
     *
     * @Route("/", name="upvotes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $upvotes = $em->getRepository('AppBundle:Upvotes')->findAll();

        return $this->render('upvotes/index.html.twig', array(
            'upvotes' => $upvotes,
        ));
    }

    /**
     * Creates a new upvote entity.
     *
     * @Route("/new", name="upvotes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $upvote = new Upvotes();
        $form = $this->createForm('AppBundle\Form\UpvotesType', $upvote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($upvote);
            $em->flush();

            return $this->redirectToRoute('upvotes_show', array('id' => $upvote->getId()));
        }

        return $this->render('upvotes/new.html.twig', array(
            'upvote' => $upvote,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a upvote entity.
     *
     * @Route("/{id}", name="upvotes_show")
     * @Method("GET")
     */
    public function showAction(Upvotes $upvote)
    {
        $deleteForm = $this->createDeleteForm($upvote);

        return $this->render('upvotes/show.html.twig', array(
            'upvote' => $upvote,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing upvote entity.
     *
     * @Route("/{id}/edit", name="upvotes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Upvotes $upvote)
    {
        $deleteForm = $this->createDeleteForm($upvote);
        $editForm = $this->createForm('AppBundle\Form\UpvotesType', $upvote);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('upvotes_edit', array('id' => $upvote->getId()));
        }

        return $this->render('upvotes/edit.html.twig', array(
            'upvote' => $upvote,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a upvote entity.
     *
     * @Route("/{id}", name="upvotes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Upvotes $upvote)
    {
        $form = $this->createDeleteForm($upvote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($upvote);
            $em->flush();
        }

        return $this->redirectToRoute('upvotes_index');
    }

    /**
     * Creates a form to delete a upvote entity.
     *
     * @param Upvotes $upvote The upvote entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Upvotes $upvote)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('upvotes_delete', array('id' => $upvote->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
