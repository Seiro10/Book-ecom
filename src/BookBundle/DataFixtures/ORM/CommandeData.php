<?php

namespace BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BookBundle\Entity\Commande;
use Doctrine\ORM\Query\AST\Functions\AbsFunction;

class CommandeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $commande1 = new Commande();
        $commande1->setUtilisateur($this->getReference('utilisateur1'));
        $commande1->setValider('1');
        $commande1->setDate(new \DateTime());
        $commande1->setReference('1');
        $commande1->setCommande(array('0' => array('1' => '2'),
            '0' => array('2' => '1'),
            '0' => array('4' => '5')
        ));
        $manager->persist($commande1);

        $commande2 = new Commande();
        $commande2->setUtilisateur($this->getReference('utilisateur2'));
        $commande2->setValider('1');
        $commande2->setDate(new \DateTime());
        $commande2->setReference('1');
        $commande2->setCommande(array('0' => array('2' => '2'),
            '0' => array('2' => '2'),
            '0' => array('4' => '5')
        ));
        $manager->persist($commande2);

        $manager->flush();



    }

    public function getOrder(){

        return 7;
    }

}
