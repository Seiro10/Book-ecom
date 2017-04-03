<?php

namespace BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BookBundle\Entity\Livre;
use Doctrine\ORM\Query\AST\Functions\AbsFunction;

class LivreData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $livre1 = new Livre();
        $livre1->setPrix('8.99');
        $livre1->setTva($this->getReference('tva2'));
        $livre1->setNom('Vendredi ou la vie sauvage');
        $livre1->setDescription('Vendredi ou la Vie sauvage est un livre de Michel Tournier paru en 1971 aux Éditions Gallimard. Il est inspiré du livre Robinson Crusoé de Daniel Defoe. C\'est l\'adaptation pour la jeunesse de son livre Vendredi ou les Limbes du Pacifique');
        $livre1->setDisponible('1');
        $livre1->setImage($this->getReference('media1'));
        $livre1->setCategorie($this->getReference('categorie1'));
        $manager->persist($livre1);

        $livre2 = new Livre();
        $livre2->setPrix('10.99');
        $livre2->setTva($this->getReference('tva2'));
        $livre2->setNom('Undertaker');
        $livre2->setDescription('Jonas Crow est de retour, à la poursuite de son passé troubleDans ce troisième tome d\'« Undertaker », Jonas Crow n\'est plus ce pauvre croque-mort solitaire...');
        $livre2->setDisponible('1');
        $livre2->setImage($this->getReference('media2'));
        $livre2->setCategorie($this->getReference('categorie2'));
        $manager->persist($livre2);

        $livre3 = new Livre();
        $livre3->setPrix('12.99');
        $livre3->setTva($this->getReference('tva2'));
        $livre3->setNom('Le royaume de Kensuké');
        $livre3->setDescription('e Royaume de Kensuké est un roman de Michael Morpurgo destiné à un public pré-adolescent ou adolescent. C\'est un livre d\'aventures s\'inspirant de Robinson Crusoé');
        $livre3->setDisponible('1');
        $livre3->setImage($this->getReference('media3'));
        $livre3->setCategorie($this->getReference('categorie1'));
        $manager->persist($livre3);

        $livre4 = new Livre();
        $livre4->setCategorie($this->getReference('categorie1'));
        $livre4->setPrix('4.99');
        $livre4->setTva($this->getReference('tva2'));
        $livre4->setNom('Yvain, le Chevalier au lion');
        $livre4->setDescription('Yvain, le Chevalier au lion est un roman de chevalerie de Chrétien de Troyes. « Le Chevalier au lion » est l\'autre nom de messire Yvain dans les romans courtois, ayant trait aux chevaliers de la Table Ronde.');
        $livre4->setDisponible('1');
        $livre4->setImage($this->getReference('media4'));
        $livre4->setCategorie($this->getReference('categorie1'));
        $manager->persist($livre4);

        $livre5 = new Livre();
        $livre5->setPrix('3.99');
        $livre5->setTva($this->getReference('tva2'));
        $livre5->setNom('La goutte d\'or');
        $livre5->setDescription('La Goutte d\'or est un roman de Michel Tournier, publié en 1985.');
        $livre5->setDisponible('1');
        $livre5->setImage($this->getReference('media5'));
        $livre5->setCategorie($this->getReference('categorie1'));
        $manager->persist($livre5);

        $livre6 = new Livre();
        $livre6->setPrix('12.99');
        $livre6->setTva($this->getReference('tva2'));
        $livre6->setNom('Barbedor');
        $livre6->setDescription('Barbedor est un conte de Michel Tournier paru en 1980, également inclus dans le roman Gaspard, Melchior et Balthazar paru la même année.');
        $livre6->setDisponible('1');
        $livre6->setImage($this->getReference('media6'));
        $livre6->setCategorie($this->getReference('categorie2'));
        $manager->persist($livre6);

        $livre7 = new Livre();
        $livre7->setPrix('15.99');
        $livre7->setTva($this->getReference('tva2'));
        $livre7->setNom('Barberousse');
        $livre7->setDescription('Qui était Barberousse? Pas seulement, comme le raconte la légende, un corsaire cupide et cruel qui semait la terreur dans toute la Méditerranée.');
        $livre7->setDisponible('1');
        $livre7->setImage($this->getReference('media9'));
        $livre7->setCategorie($this->getReference('categorie2'));
        $manager->persist($livre7);

        $livre8 = new Livre();
        $livre8->setPrix('17.99');
        $livre8->setTva($this->getReference('tva2'));
        $livre8->setNom('Noblesse');
        $livre8->setDescription('La noblesse d\'un royaume, d\'un pays, d\'un peuple, d\'un principauté ou d\'une province renvoie généralement à la notion d\'ordre ou de caste et désigne alors la condition d\'un groupe social distinct et hiérarchisé jouissant de privilèges');
        $livre8->setDisponible('1');
        $livre8->setImage($this->getReference('media10'));
        $livre8->setCategorie($this->getReference('categorie2'));
        $manager->persist($livre8);

        $manager->flush();



    }

    public function getOrder(){

        return 4;
    }
}
