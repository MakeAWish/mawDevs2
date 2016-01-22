<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Wish;
use AppBundle\Form\WishType;

/**
 * Wish controller.
 *
 * @Route("/wish")
 */
class WishController extends Controller
{
    /**
     * Lists all Wish entities.
     *
     * @Route("/", name="wish_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();
        $currentUser = $this->getUser();
        $wishes = $currentUser->getWishes()->toArray();

        return $this->render('wish/index.html.twig', array(
            'wishes' => $wishes,
        ));
    }

    /**
     * Creates a new Wish entity.
     *
     * @Route("/new", name="wish_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $wish = new Wish();
        $form = $this->createForm('AppBundle\Form\WishType', $wish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wish);
            $em->flush();

            return $this->redirectToRoute('wish_show', array('id' => $wish->getId()));
        }

        return $this->render('wish/new.html.twig', array(
            'wish' => $wish,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Wish entity.
     *
     * @Route("/{id}", name="wish_show")
     * @Method("GET")
     */
    public function showAction(Wish $wish)
    {
        $deleteForm = $this->createDeleteForm($wish);

        return $this->render('wish/show.html.twig', array(
            'wish' => $wish,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Wish entity.
     *
     * @Route("/{id}/edit", name="wish_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Wish $wish)
    {
        $deleteForm = $this->createDeleteForm($wish);
        $editForm = $this->createForm('AppBundle\Form\WishType', $wish);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wish);
            $em->flush();

            return $this->redirectToRoute('wish_edit', array('id' => $wish->getId()));
        }

        return $this->render('wish/edit.html.twig', array(
            'wish' => $wish,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Wish entity.
     *
     * @Route("/{id}", name="wish_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Wish $wish)
    {
        $form = $this->createDeleteForm($wish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($wish);
            $em->flush();
        }

        return $this->redirectToRoute('wish_index');
    }

    /**
     * Creates a form to delete a Wish entity.
     *
     * @param Wish $wish The Wish entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Wish $wish)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wish_delete', array('id' => $wish->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
