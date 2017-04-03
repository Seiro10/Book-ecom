<?php

namespace BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BookBundle\Entity\Media;
use Doctrine\ORM\Query\AST\Functions\AbsFunction;

class MediaData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $media1 = new Media();
        $media1->setPath('img/Vendredi_ou_la_vie_sauvage.jpeg');
        $media1->setAlt('Vendredi ou la vie sauvage');
        $manager->persist($media1);

        $media2 = new Media();
        $media2->setPath('img/Undertaker.jpeg');
        $media2->setAlt('La promesse de l\'aube');
        $manager->persist($media2);

        $media3 = new Media();
        $media3->setPath('img/Le_royaume_de_kensuké.jpeg');
        $media3->setAlt('Le royaume de Kensuké');
        $manager->persist($media3);

        $media4 = new Media();
        $media4->setPath('img/Yvain_le_chevalier_lion.jpeg');
        $media4->setAlt('Yvain ou le Chevalier au lion');
        $manager->persist($media4);

        $media5 = new Media();
        $media5->setPath('img/La_goutte_d\'or.jpeg');
        $media5->setAlt('La goutte d\'or');
        $manager->persist($media5);

        $media6 = new Media();
        $media6->setPath('img/Barbedor.jpeg');
        $media6->setAlt('Barbe d\'or');
        $manager->persist($media6);

        $media7 = new Media();
        $media7->setPath('http://www.tapsoft.in/img/ecom.jpg');
        $media7->setAlt('Fantastique');
        $manager->persist($media7);

        $media8 = new Media();
        $media8->setPath('http://www.tapsoft.in/img/ecom.jpg');
        $media8->setAlt('littérature');
        $manager->persist($media8);

        $media9 = new Media();
        $media9->setPath('img/Barberousse.jpeg');
        $media9->setAlt('Barberousse');
        $manager->persist($media9);

        $media10 = new Media();
        $media10->setPath('img/Noblesse.jpeg');
        $media10->setAlt('Noblesse');
        $manager->persist($media10);


        $manager->flush();

        $this->addReference('media1' , $media1);
        $this->addReference('media2' , $media2);
        $this->addReference('media3' , $media3);
        $this->addReference('media4' , $media4);
        $this->addReference('media5' , $media5);
        $this->addReference('media6' , $media6);
        $this->addReference('media7' , $media7);
        $this->addReference('media8' , $media8);
        $this->addReference('media9' , $media9);
        $this->addReference('media10' ,$media10);
    }

    public function getOrder(){

        return 1;
    }
}
