<?php

namespace App\Controller;

use App\Entity\Bidule;
use App\Form\BiduleType;
use App\Repository\BiduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bidule")
 */
class BiduleController extends AbstractController
{
    /**
     * @Route("/", name="bidule_index", methods={"GET"})
     */
    public function index(BiduleRepository $biduleRepository): Response
    {
        return $this->render('bidule/index.html.twig', [
            'bidules' => $biduleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bidule_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bidule = new Bidule();
        $form = $this->createForm(BiduleType::class, $bidule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bidule);
            $entityManager->flush();

            return $this->redirectToRoute('bidule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bidule/new.html.twig', [
            'bidule' => $bidule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bidule_show", methods={"GET"})
     */
    public function show(Bidule $bidule): Response
    {
        return $this->render('bidule/show.html.twig', [
            'bidule' => $bidule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bidule_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Bidule $bidule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BiduleType::class, $bidule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('bidule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bidule/edit.html.twig', [
            'bidule' => $bidule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bidule_delete", methods={"POST"})
     */
    public function delete(Request $request, Bidule $bidule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bidule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bidule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bidule_index', [], Response::HTTP_SEE_OTHER);
    }
}
