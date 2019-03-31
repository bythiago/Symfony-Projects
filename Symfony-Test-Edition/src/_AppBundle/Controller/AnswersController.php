<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Answers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Answer controller.
 *
 * @Route("answers")
 */
class AnswersController extends Controller
{
    /**
     * Lists all answer entities.
     *
     * @Route("/", name="answers_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $answers = $em->getRepository('AppBundle:Answers')->findAll();

        return $this->render('answers/index.html.twig', array(
            'answers' => $answers,
        ));
    }

    /**
     * Creates a new answer entity.
     *
     * @Route("/new", name="answers_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $answer = new Answers();
        $form = $this->createForm('AppBundle\Form\AnswersType', $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($answer);
            $em->flush();

            return $this->redirectToRoute('answers_show', array('id' => $answer->getId()));
        }

        return $this->render('answers/new.html.twig', array(
            'answer' => $answer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a answer entity.
     *
     * @Route("/{id}", name="answers_show")
     * @Method("GET")
     */
    public function showAction(Answers $answer)
    {
        $deleteForm = $this->createDeleteForm($answer);

        return $this->render('answers/show.html.twig', array(
            'answer' => $answer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing answer entity.
     *
     * @Route("/{id}/edit", name="answers_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Answers $answer)
    {
        $deleteForm = $this->createDeleteForm($answer);
        $editForm = $this->createForm('AppBundle\Form\AnswersType', $answer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('answers_edit', array('id' => $answer->getId()));
        }

        return $this->render('answers/edit.html.twig', array(
            'answer' => $answer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a answer entity.
     *
     * @Route("/{id}", name="answers_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Answers $answer)
    {
        $form = $this->createDeleteForm($answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($answer);
            $em->flush();
        }

        return $this->redirectToRoute('answers_index');
    }

    /**
     * Creates a form to delete a answer entity.
     *
     * @param Answers $answer The answer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Answers $answer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('answers_delete', array('id' => $answer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
