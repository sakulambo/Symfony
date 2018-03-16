<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subtask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Subtask controller.
 *
 * @Route("subtask")
 */
class SubtaskController extends Controller
{
    /**
     * Lists all subtask entities.
     *
     * @Route("/", name="subtask_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subtasks = $em->getRepository('AppBundle:Subtask')->findAll();

        return $this->render('@App/private/subtask/list_subtask.html.twig', array(
            'subtasks' => $subtasks,
        ));
    }

    /**
     * Creates a new subtask entity.
     *
     * @Route("/new", name="subtask_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $subtask = new Subtask();
        $form = $this->createForm('AppBundle\Form\SubtaskType', $subtask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $subtask->setUpdatedAt(new \DateTime('now'));
            $subtask->setCreatedAt(new \DateTime('now'));
            $em->persist($subtask);
            $em->flush();

            return $this->redirectToRoute('subtask_index', array('id' => $subtask->getId()));
        }

        return $this->render('@App/private/subtask/create_subtask.html.twig', array(
            'subtask' => $subtask,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subtask entity.
     *
     * @Route("/{id}/edit", name="subtask_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Subtask $subtask
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request,Subtask $subtask)
    {
        $editForm = $this->createForm('AppBundle\Form\SubtaskType', $subtask);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subtask_index', array('id' => $subtask->getId()));
        }

        return $this->render('@App/private/subtask/edit_subtask.html.twig', array(
            'subtask' => $subtask,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a subtask entity.
     *
     * @Route("/{id}", name="subtask_delete")
     * @Method("DELETE")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $subtask = $this->getDoctrine()
            ->getRepository("AppBundle:Subtask")
            ->findOneById($request->get("id"));

        if($subtask != null){
            $em = $this->getDoctrine()->getManager();
            $em->remove($subtask);
            $em->flush();
        }else{
            return $this->redirectToRoute('error_500');
        }

        return $this->redirectToRoute('subtask_index');
    }


}
