<?php

namespace UtilisateurBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $factures = $em->getRepository('BookBundle:Commande')->findByUser($user->getId());


        return $this->render('UtilisateurBundle:Default:index.html.twig' , array('factures' => $factures));
    }

    public function detailsAction($id){

        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){

            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('BookBundle:Commande')->find($id);

        return $this->render('UtilisateurBundle:Default:detailsFacture.html.twig', array('facture' => $facture));

    }
}
