<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;
use App\Entity\Suppliers;

class TestController extends AbstractController {
    /**
     * @Route("/test", name="test")
     */
    public function index() {
        $repo = $this->getDoctrine()->getRepository(Products::class);
        $obj = $repo->findAll();
        $repo = $this->getDoctrine()->getRepository(Suppliers::class);
        $obj2 = $repo->findAll();
        foreach ($obj as $value) {
            $value->getSuppliers()->getName();
        }
        return $this->render('test/index.html.twig', [
            'obj' => $obj,
            'obj2' => $obj2
        ]); 
    }
}