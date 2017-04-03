<?php

namespace BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BookBundle\Entity\Tva;
use Doctrine\ORM\Query\AST\Functions\AbsFunction;

class TvaData extends AbstractFixture  implements  OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $tva2 = new Tva();
        $tva2->setMultiplicate('0.833');
        $tva2->setNom('TVA 20%');
        $tva2->setValeur('20') ;
        $manager->persist($tva2);

        $manager->flush();

        $this->addReference('tva2' , $tva2);


    }

    public function getOrder(){

        return 2;
    }

}
