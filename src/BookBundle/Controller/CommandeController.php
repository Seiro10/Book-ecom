<?php

namespace BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use BookBundle\Entity\UtilisateurAdresse;
use BookBundle\Entity\Commande;
use BookBundle\Entity\Livre;

class CommandeController extends Controller
{


    public function facture()
{
    $em = $this->getDoctrine()->getManager();
    $generator = $this->container->get('security.secure_random');
    $session = $this->getRequest()->getSession();
    $adresse = $session->get('adresse');
    $panier = $session->get('panier');
    $commande = array();
    $totalHT = 0;
    $totalTVA = 0;

    $facturation = $em->getRepository('BookBundle:UtilisateurAdresse')->find($adresse['facturation']);
    $livraison = $em->getRepository('BookBundle:UtilisateurAdresse')->find($adresse['livraison']);
    $produits = $em->getRepository('BookBundle:Livre')->byPanier(array_keys($session->get('panier')));

    foreach($produits as $produit)
    {
        $prixHT = ($produit->getPrix() * $panier[$produit->getId()]);
        $prixTTC = ($produit->getPrix() * $panier[$produit->getId()] / $produit->getTva()->getMultiplicate());
        $totalHT += $prixHT;


        if (!isset($commande['tva']['%'.$produit->getTva()->getValeur()]))
            $commande['tva']['%'.$produit->getTva()->getValeur()] = round($prixTTC - $prixHT,2);
        else
            $commande['tva']['%'.$produit->getTva()->getValeur()] += round($prixTTC - $prixHT,2);

        $totalTVA += round($prixTTC - $prixHT, 2);

        $commande['produit'][$produit->getId()] = array('reference' => $produit->getNom(),
            'quantite' => $panier[$produit->getId()],
            'prixHT' => round($produit->getPrix(),2),
            'prixTTC' => round($produit->getPrix() / $produit->getTva()->getMultiplicate(),2));
    }

    $commande['livraison'] = array('prenom' => $livraison->getPrenom(),
        'nom' => $livraison->getNom(),
        'telephone' => $livraison->getTelephone(),
        'adresse' => $livraison->getAdresse(),
        'cp' => $livraison->getCp(),
        'ville' => $livraison->getVille(),
        'pays' => $livraison->getPays(),
        'complement' => $livraison->getComplement());
    $commande['facturation'] = array('prenom' => $facturation->getPrenom(),
        'nom' => $facturation->getNom(),
        'telephone' => $facturation->getTelephone(),
        'adresse' => $facturation->getAdresse(),
        'cp' => $facturation->getCp(),
        'ville' => $facturation->getVille(),
        'pays' => $facturation->getPays(),
        'complement' => $facturation->getComplement());

    $commande['prixHT'] = round($totalHT,2);
    $commande['prixTTC'] = round($totalHT + $totalTVA,2);
    $commande['token'] = bin2hex($generator->nextBytes(20));
    return $commande;
}


    public function prepareCommandeAction()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();

        if (!$session->has('commande')){

            $commande = new Commande();
        }

        else{

            $commande = $em->getRepository('BookBundle:Commande')->find($session->get('commande'));
        }

        $commande->setDate(new \DateTime());
        $commande->setUtilisateur($this->container->get('security.context')->getToken()->getUser());
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommande($this->facture());


        if (!$session->has('commande')) {
            $em->persist($commande);
            $session->set('commande',$commande);
        }

        $em->flush();
        return new Response($commande->getId());
    }

    public function paiementAction($id, Request $request){

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('BookBundle:Commande')->find($id);

        $commande->setValider(1);

        $em->persist($commande);
        $em->flush();

        $session->remove('panier');
        $session->remove('adresse');
        $session->remove('commande');

        $this->addFlash('success' , 'Votre commande a bien été enregistrée');


        return $this->redirectToRoute('book_homepage');

    }



}
