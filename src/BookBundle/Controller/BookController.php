<?php

namespace BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $livres = $em->getRepository('BookBundle:Livre')->findAll();

        return $this->render('BookBundle:Default:index.html.twig', array('livres' => $livres));
    }

    public function presentationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $livre = $em->getRepository('BookBundle:Livre')->find($id);
        $livrelikes = $em->getRepository('BookBundle:Livre')->findOther($id);
        return $this->render('BookBundle:Default:presentation.html.twig', array('livre' => $livre , 'livrelikes' => $livrelikes));
    }

}
