<?php

namespace BookBundle\Controller;

use BookBundle\Entity\UtilisateurAdresse;
use BookBundle\Form\UtilisateurAdresseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


class PanierController extends Controller
{
    public function panierAction(Request $request){

        $session = $request->getSession();

        if (!$session->has('panier')){

            $session->set('panier', array());
        }

        $em = $this->getDoctrine()->getManager();
        $livres = $em->getRepository('BookBundle:Livre')->byPanier(array_keys($session->get('panier')));

        return $this->render('BookBundle:Default:panier/panier.html.twig', array('livres' => $livres , 'panier' => $session->get('panier')));

    }

    public function livraisonAction(Request $request){

    $utilisateur = $this->container->get('security.token_storage')->getToken()->getUser();
    $entity = new UtilisateurAdresse();
    $form = $this->createForm(new UtilisateurAdresseType(), $entity);

     if ($this->get('request')->getMethod() == 'POST') {

         $form->handleRequest($request);
         if ($form->isValid()){

             $em = $this->getDoctrine()->getManager();
             $entity->setUtilisateur($utilisateur);
             $em->persist($entity);
             $em->flush();
             return $this->redirect($this->generateUrl('livraison'));

         }

     }

     return $this->render('BookBundle:Default:panier/livraison.html.twig', array('utilisateur' => $utilisateur, 'form' => $form->createView()));
    }

    public function setLivraisonOnSession(){

        $session = $this->getRequest()->getSession();
        if (!$session->has('adresse')){

            $session->set('adresse', array());
        }

        $adresse = $session->get('adresse');

        if ($this->getRequest()->request->get('livraison') != null && $this->getRequest()->request->get('facturation') != null){

            $adresse['livraison'] = $this->getRequest()->request->get('livraison');
            $adresse['facturation'] = $this->getRequest()->request->get('facturation');
        }else{

            return $this->redirect($this->generateUrl('validation'));
        }

        $session->set('adresse' , $adresse);

        return $this->redirect($this->generateUrl('validation'));
    }


    public function validationAction()
    {
        if ($this->get('request')->getMethod() == 'POST')
            $this->setLivraisonOnSession();

        $em = $this->getDoctrine()->getManager();
        $prepareCommande = $this->forward('BookBundle:Commande:prepareCommande');
        $commande = $em->getRepository('BookBundle:Commande')->find($prepareCommande->getContent());
        return $this->render('BookBundle:Default:panier/validation.html.twig', array('commande' => $commande));
    }

    public function ajoutAction($id,Request $request)
    {
        $session = $request->getSession();

        if (!$session->has('panier')) $session->set('panier' , array());
        {

        $panier = $session->get('panier');

        if (array_key_exists($id, $panier))
        {

            if ($request->query->get('qte') != null)
            {

                $panier[$id] = $request->query->get('qte');
                $this->addFlash('success', 'La quantité a été modifiée');

            }
        }
         else{

             if ($request->query->get('qte') != null)
             {

                $panier[$id] = $request->query->get('qte');

             }else{

                    $panier[$id] = 1;

                  }
                $this->addFlash('success', 'article ajouté avec succés !');
             }
        }
        $session->set('panier', $panier);
        return $this->redirect($this->generateUrl('panier'));
    }

    public function supprimerAction($id, Request $request){

        $session = $request->getSession();
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier)){

            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->addFlash('success', 'Article supprimé avec succés');
        }

        return $this->redirect($this->generateUrl('panier'));
    }



}






















