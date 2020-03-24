<?php

namespace App\Controller;

use App\Entity\EmailList;
use App\Form\EmailListType;
use App\Repository\EmailListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/email/list")
 */
class EmailListController extends AbstractController
{
    /**
     * @Route("/", name="email_list_index", methods={"GET"})
     */
    public function index(EmailListRepository $emailListRepository): Response
    {
        return $this->render('email_list/index.html.twig', [
            'email_lists' => $emailListRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="email_list_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $emailList = new EmailList();
        $form = $this->createForm(EmailListType::class, $emailList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($emailList);
            $entityManager->flush();

            return $this->redirectToRoute('email_list_index');
        }

        return $this->render('email_list/new.html.twig', [
            'email_list' => $emailList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="email_list_show", methods={"GET"})
     */
    public function show(EmailList $emailList): Response
    {
        return $this->render('email_list/show.html.twig', [
            'email_list' => $emailList,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="email_list_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EmailList $emailList): Response
    {
        $form = $this->createForm(EmailListType::class, $emailList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('email_list_index');
        }

        return $this->render('email_list/edit.html.twig', [
            'email_list' => $emailList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="email_list_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EmailList $emailList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emailList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($emailList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('email_list_index');
    }
}
