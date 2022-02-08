<?php

namespace App\Controller;

use App\Entity\Truc;
use App\Form\TrucType;
use App\Repository\TrucRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/truc")
 */
class TrucController extends AbstractController
{
    /**
     * @Route("/", name="truc_index", methods={"GET"})
     */
    public function index(TrucRepository $trucRepository): Response
    {
        return $this->render('truc/index.html.twig', [
            'trucs' => $trucRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="truc_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $truc = new Truc();
        $form = $this->createForm(TrucType::class, $truc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($truc);
            $entityManager->flush();

            return $this->redirectToRoute('truc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('truc/new.html.twig', [
            'truc' => $truc,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="truc_show", methods={"GET"})
     */
    public function show(Truc $truc): Response
    {
        return $this->render('truc/show.html.twig', [
            'truc' => $truc,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="truc_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Truc $truc, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrucType::class, $truc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('truc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('truc/edit.html.twig', [
            'truc' => $truc,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="truc_delete", methods={"POST"})
     */
    public function delete(Request $request, Truc $truc, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$truc->getId(), $request->request->get('_token'))) {
            $entityManager->remove($truc);
            $entityManager->flush();
        }

        return $this->redirectToRoute('truc_index', [], Response::HTTP_SEE_OTHER);
    }
}
