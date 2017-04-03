<?php

namespace BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategorieController extends Controller
{
   public function indexAction(){

       $em = $this->getDoctrine()->getManager();
       $categories = $em->getRepository('BookBundle:Categorie')->findAll();

       return $this->render('UtilisateurBundle:Default:modulesUsed/menu.html.twig', array('categories' => $categories));

   }

    public function categorieAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $livres = $em->getRepository('BookBundle:Livre')->byCategorie($id);

        return $this->render('BookBundle:Default:index.html.twig', array('livres' => $livres));
    }
}
