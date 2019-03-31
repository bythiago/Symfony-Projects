<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlogComment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Blogcomment controller.
 *
 * @Route("blogcomment")
 */
class BlogCommentController extends Controller
{
    /**
     * Lists all blogComment entities.
     *
     * @Route("/", name="blogcomment_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $blogComments = $em->getRepository('AppBundle:BlogComment')->findAll();

        return $this->render('blogcomment/index.html.twig', array(
            'blogComments' => $blogComments,
        ));
    }

    /**
     * Creates a new blogComment entity.
     *
     * @Route("/new", name="blogcomment_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $blogComment = new Blogcomment();
        $form = $this->createForm('AppBundle\Form\BlogCommentType', $blogComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blogComment);
            $em->flush();

            return $this->redirectToRoute('blogcomment_show', array('id' => $blogComment->getId()));
        }

        return $this->render('blogcomment/new.html.twig', array(
            'blogComment' => $blogComment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a blogComment entity.
     *
     * @Route("/{id}", name="blogcomment_show")
     * @Method("GET")
     */
    public function showAction(BlogComment $blogComment)
    {
        $deleteForm = $this->createDeleteForm($blogComment);

        return $this->render('blogcomment/show.html.twig', array(
            'blogComment' => $blogComment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing blogComment entity.
     *
     * @Route("/{id}/edit", name="blogcomment_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BlogComment $blogComment)
    {
        $deleteForm = $this->createDeleteForm($blogComment);
        $editForm = $this->createForm('AppBundle\Form\BlogCommentType', $blogComment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blogcomment_edit', array('id' => $blogComment->getId()));
        }

        return $this->render('blogcomment/edit.html.twig', array(
            'blogComment' => $blogComment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a blogComment entity.
     *
     * @Route("/{id}", name="blogcomment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BlogComment $blogComment)
    {
        $form = $this->createDeleteForm($blogComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($blogComment);
            $em->flush();
        }

        return $this->redirectToRoute('blogcomment_index');
    }

    /**
     * Creates a form to delete a blogComment entity.
     *
     * @param BlogComment $blogComment The blogComment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BlogComment $blogComment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blogcomment_delete', array('id' => $blogComment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
