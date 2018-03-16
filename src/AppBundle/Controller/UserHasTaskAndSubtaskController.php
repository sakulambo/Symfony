<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserHasTaskAndSubtask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Userhastaskandsubtask controller.
 *
 * @Route("userhastaskandsubtask")
 */
class UserHasTaskAndSubtaskController extends Controller
{
    /**
     * Lists all userHasTaskAndSubtask entities.
     *
     * @Route("/", name="userhastaskandsubtask_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userHasTaskAndSubtasks = $em->getRepository('AppBundle:UserHasTaskAndSubtask')->findAll();

        return $this->render('@App/private/userhastaskandsubtask/list_userhastaskandsubtask.html.twig', array(
            'userHasTaskAndSubtasks' => $userHasTaskAndSubtasks,
        ));
    }

    /**
     * Creates a new userHasTaskAndSubtask entity.
     *
     * @Route("/new", name="userhastaskandsubtask_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $userHasTaskAndSubtask = new Userhastaskandsubtask();
        $form = $this->createForm('AppBundle\Form\UserHasTaskAndSubtaskType', $userHasTaskAndSubtask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $userHasTaskAndSubtask->setCreatedAt(new \DateTime('now'));
            $userHasTaskAndSubtask->setUpdatedAt(new \DateTime('now'));
            $em->persist($userHasTaskAndSubtask);
            $em->flush();

            return $this->redirectToRoute('userhastaskandsubtask_index', array('id' => $userHasTaskAndSubtask->getId()));
        }

        return $this->render('@App/private/userhastaskandsubtask/create_userhastaskandsubtask.html.twig', array(
            'userHasTaskAndSubtask' => $userHasTaskAndSubtask,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing userHasTaskAndSubtask entity.
     *
     * @Route("/{id}/edit", name="userhastaskandsubtask_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param UserHasTaskAndSubtask $userHasTaskAndSubtask
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, UserHasTaskAndSubtask $userHasTaskAndSubtask)
    {

        $editForm = $this->createForm('AppBundle\Form\UserHasTaskAndSubtaskType', $userHasTaskAndSubtask);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userhastaskandsubtask_edit', array('id' => $userHasTaskAndSubtask->getId()));
        }

        return $this->render('@App/private/userhastaskandsubtask/edit_userhastaskandsubtask.html.twig', array(
            'userHasTaskAndSubtask' => $userHasTaskAndSubtask,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a userHasTaskAndSubtask entity.
     *
     * @Route("/{id}", name="userhastaskandsubtask_delete")
     * @Method("DELETE")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $userhastaskandsubtask = $this->getDoctrine()
            ->getRepository("AppBundle:UserHasTaskAndSubtask")
            ->findOneById($request->get("id"));

        var_dump($userhastaskandsubtask);
        die();

        $em = $this->getDoctrine()->getManager();
        $em->remove($userhastaskandsubtask);
        $em->flush();


        return $this->redirectToRoute('userhastaskandsubtask_index');
    }

}
