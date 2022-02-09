<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/profil")
 * @method render(string $string, array $array)
 */
class ProfilController extends AbstractController{

    /** 
    * @Route("/", name="profil")
    */
    public function index() :Response {
        return $this->render('profil/detail.html.twig',["info"=>["nom"=>'Loper', "prenom"=>'Dave', "mail"=>'daveloper@code.dom', "truc"=>'01/01/1970']]);
    }
}