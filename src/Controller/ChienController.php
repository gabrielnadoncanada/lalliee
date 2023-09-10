<?php

namespace App\Controller;

use App\Entity\Chien;
use App\Form\ChienType;
use App\Repository\ChienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/chiens")
 */
class ChienController extends AbstractController
{
    /**
     * @Route("/", name="wcm_chiens_index", methods={"GET"})
     */
    public function index(ChienRepository $chienRepository): Response
    {
        return $this->render('@Wcm/_shared/_index.html.twig', [
            'entity' => $chienRepository->findAll(),
            'entity_title' => 'chiens',
            'fields' => ['id','title']
        ]);
    }

    /**
     * @Route("/new", name="wcm_chiens_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chien = new Chien();
        $form = $this->createForm(ChienType::class, $chien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chien);
            $entityManager->flush();

            return $this->redirectToRoute('wcm_chiens_index');
        }

        return $this->render('@Wcm/_shared/_new.html.twig', [
            'chien' => $chien,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="wcm_chiens_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chien $chien): Response
    {
        $form = $this->createForm(ChienType::class, $chien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wcm_chiens_index');
        }

        return $this->render('@Wcm/_shared/_edit.html.twig', [
            'chien' => $chien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="wcm_chiens_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Chien $chien): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chien->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('wcm_chiens_index');
    }
}
