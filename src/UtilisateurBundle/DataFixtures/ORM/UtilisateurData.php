<?php

namespace BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UtilisateurBundle\Entity\Utilisateur;
use Doctrine\ORM\Query\AST\Functions\AbsFunction;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class UtilisateurData extends AbstractFixture  implements  OrderedFixtureInterface, ContainerAwareInterface
{

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

    }

    public function load(ObjectManager $manager)
    {
        $utilisateur1 = new Utilisateur();
        $utilisateur1->setUsername('Romain');
        $utilisateur1->setEmail('mouloud@hotmail.fr');
        $utilisateur1->setEnabled('1');
        $utilisateur1->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur1)->encodePassword('poupou', $utilisateur1->getSalt()));
        $manager->persist($utilisateur1);

        $utilisateur2 = new Utilisateur();
        $utilisateur2->setUsername('Kalrl');
        $utilisateur2->setEmail('karl@hotmail.fr');
        $utilisateur2->setEnabled('1');
        $utilisateur2->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur2)->encodePassword('youhou', $utilisateur2->getSalt()));
        $manager->persist($utilisateur2);

        $utilisateur3 = new Utilisateur();
        $utilisateur3->setUsername('Lina');
        $utilisateur3->setEmail('lina@hotmail.fr');
        $utilisateur3->setEnabled('1');
        $utilisateur3->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur3)->encodePassword('balali', $utilisateur3->getSalt()));
        $manager->persist($utilisateur3);

        $this->addReference('utilisateur1' , $utilisateur1);
        $this->addReference('utilisateur2' , $utilisateur2);
        $this->addReference('utilisateur3' , $utilisateur3);

        $manager->flush();



    }

    public function getOrder(){

        return 5;
    }

}
