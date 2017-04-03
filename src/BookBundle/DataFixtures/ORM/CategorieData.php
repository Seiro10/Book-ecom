<?php

namespace BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BookBundle\Entity\Categorie;
use Doctrine\ORM\Query\AST\Functions\AbsFunction;

class CategorieData extends AbstractFixture  implements  OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categorie();
        $categorie1->setNom('Fantastique');
        $categorie1->setImage($this->getReference('media7'));
        $manager->persist($categorie1);

        $categorie2 = new Categorie();
        $categorie2->setNom('Roman');
        $categorie2->setImage($this->getReference('media8'));
        $manager->persist($categorie2);

        $manager->flush();

        $this->addReference('categorie1', $categorie1);
        $this->addReference('categorie2', $categorie2);

    }

    public function getOrder(){

        return 2;
    }

}
