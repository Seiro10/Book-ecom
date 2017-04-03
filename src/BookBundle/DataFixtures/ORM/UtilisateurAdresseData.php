<?php

namespace BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BookBundle\Entity\UtilisateurAdresse;
use Doctrine\ORM\Query\AST\Functions\AbsFunction;

class UtilisateurAdresseData extends AbstractFixture  implements  OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $adresse1 = new UtilisateurAdresse();
        $adresse1->setUtilisateur($this->getReference('utilisateur1'));
        $adresse1->setNom('Mouloud');
        $adresse1->setPrenom('Lilo');
        $adresse1->setTelephone('0602050301');
        $adresse1->setAdresse('3 rue leroy seme');
        $adresse1->setCp('76500');
        $adresse1->setPays('France');
        $adresse1->setVille('Le Havre');
        $adresse1->setComplement('église');
        $manager->persist($adresse1);

        $adresse2 = new UtilisateurAdresse();
        $adresse2->setUtilisateur($this->getReference('utilisateur2'));
        $adresse2->setNom('leblanc');
        $adresse2->setPrenom('Albert');
        $adresse2->setTelephone('0615052502');
        $adresse2->setAdresse('3 rue michel');
        $adresse2->setCp('62299');
        $adresse2->setPays('France');
        $adresse2->setVille('Lens');
        $adresse2->setComplement('plage');
        $manager->persist($adresse2);

        $manager->flush();

    }

    public function getOrder(){

        return 6;
    }

}
