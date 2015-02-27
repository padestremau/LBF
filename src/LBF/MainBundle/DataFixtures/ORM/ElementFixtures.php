<?php
// src/LBF/MainBundle/DataFixtures/ORM/ElementFixtures.php

namespace LBF\MainBundle\DataFixtures\ORM;

use LBF\MainBundle\Entity\Element;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class ElementFixtures implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $names_Element = array(
        // Embutidos
        '1'=>'Chorizo de cerdo',
        '2'=>'Chorizo verde',
        
        // Patés
        '3'=>'Paté de foie al pisco',
        '4'=>'Terrine de campagne',
        '5'=>'Rillettes de porc',
        
        // Jamones
        '6'=>'Jambon de Paris',
        '7'=>'Lardons',

        // Epicerie fine
        '8'=>'Marmelada Limón',
        '9'=>'Marmelada Fresa',
        '10'=>'Marmelada Naranja',
        '11'=>'Marmelada Durazno',
        '12'=>'Marmelada Manguo Limón',
        '13'=>'Marmelada Manzana Uva',
        '14'=>'Sablés bretons',
        '15'=>'Meringues',
        '16'=>"Confits d'oigons",
        '17'=>'Tapenade',
        '18'=>"Caviar d'aubergines",
        '19'=>"Moutarde",
        
        // Traiteur
        '20'=>"Empanadas",
        '21'=>"Cake"
        );
        
        
    $descriptions_Element = array(
        // Embutidos
        '1'=>'Différentes parties du cochon relevées par un savant mélange d’épices. Tous les ingrédients utilisés sont frais.',
        '2'=>'Différentes parties du cochon auxquelles sont ajouté un mélange de légumes, blettes et épinards. Tous les ingrédients utilisés sont frais.',
        
        // Patés
        '3'=>'Foie de volaille cuisinés au vin blanc et relevé au Pisco. Tous les ingrédients utilisés sont frais.',
        '4'=>'Différentes viandes (bœuf et porc) cuisinées avec un savant mélange d’épices et relevé au Pisco. Tous les ingrédients utilisés sont frais.',
        '5'=>'Poitrine de porc cuisinée selon un processus long et délicat. Tous les ingrédients utilisés sont frais.',
        
        // Jamones
        '6'=>'Jambe de porc sélectionné salé en saumure parfumée et cuit en moule au four. Tous les ingrédients utilisés sont frais.',
        '7'=>'Poitrine de porc salée et saumurée coupée à la française. Tous les ingrédients utilisés sont frais.',

        // Epicerie fine
        '8'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '9'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '10'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '11'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '12'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '13'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '14'=>'Biscuit au beurre',
        '15'=>"Blancs d'oeuf au sucre",
        '16'=>"Oigons fris et bouillis puis malaxés en compote.",
        '17'=>'Assortiment d’olive et d’épices à tartiner',
        '18'=>"Assortiment d’aubergine et d’épices à tartiner",
        '19'=>"Moutarde et moutarde à l'ancienne",
        
        // Traiteur
        '20'=>"Recette péruvienne avec une garniture à la saucisse.",
        '21'=>"Cake aux olives et aux lardons"
        );
    
    $prices_Element = array(
        // Embutidos
        '1'=>'20',
        '2'=>'25',
        
        // Patés
        '3'=>'30',
        '4'=>'35',
        '5'=>'25',
        
        // Jamones
        '6'=>'20',
        '7'=>'20',

        // Epicerie fine
        '8'=>'15',
        '9'=>'15',
        '10'=>'15',
        '11'=>'15',
        '12'=>'15',
        '13'=>'15',
        '14'=>'20',
        '15'=>'20',
        '16'=>'20',
        '17'=>'20',
        '18'=>'20',
        '19'=>'20',
        
        // Traiteur
        '20'=>'20',
        '21'=>'20'
        );

    
    $quantities_Element = array(
        // Embutidos
        '1'=>'5',
        '2'=>'8',
        
        // Patés
        '3'=>'9',
        '4'=>'10',
        '5'=>'5',
        
        // Jamones
        '6'=>'100',
        '7'=>'120',

        // Epicerie fine
        '8'=>'6',
        '9'=>'8',
        '10'=>'9',
        '11'=>'4',
        '12'=>'4',
        '13'=>'4',
        '14'=>'10',
        '15'=>'10',
        '16'=>'10',
        '17'=>'10',
        '18'=>'10',
        '19'=>'10',
        
        // Traiteur
        '20'=>'10',
        '21'=>'10'
        );

    $units_Element = array(
        // Embutidos
        '1'=>'1',
        '2'=>'1',
        
        // Patés
        '3'=>'1',
        '4'=>'1',
        '5'=>'1',
        
        // Jamones
        '6'=>'10',
        '7'=>'10',

        // Epicerie fine
        '8'=>'0',
        '9'=>'0',
        '10'=>'0',
        '11'=>'0',
        '12'=>'0',
        '13'=>'0',
        '14'=>'3',
        '15'=>'3',
        '16'=>'0',
        '17'=>'0',
        '18'=>'0',
        '19'=>'0',
        
        // Traiteur
        '20'=>'2',
        '21'=>'0'
        );

    $weights_Element = array(
        // Embutidos
        '1'=>'200',
        '2'=>'250',
        
        // Patés
        '3'=>'400',
        '4'=>'700',
        '5'=>'400',
        
        // Jamones
        '6'=>'20', // 10 tranches !
        '7'=>'20',  // 10 tranches !

        // Epicerie fine
        '8'=>'300',
        '9'=>'300',
        '10'=>'300',
        '11'=>'300',
        '12'=>'300',
        '13'=>'300',
        '14'=>'20',
        '15'=>'10',
        '16'=>'200',
        '17'=>'150',
        '18'=>'180',
        '19'=>'200',
        
        // Traiteur
        '20'=>'50',
        '21'=>'50'
        );

    $types_Element = array(
        // Embutidos
        '1'=>'Chorizo_de_cerdo',
        '2'=>'Chorizo_verde',
        
        // Patés
        '3'=>'Pate_de_foie_al_pisco',
        '4'=>'Terrine_de_campagne',
        '5'=>'Rillettes_de_porc',
        
        // Jamones
        '6'=>'Jamon_frances',
        '7'=>'Jamon_serano',

        // Epicerie fine
        '8'=>'Marmelada_Limon',
        '9'=>'Marmelada_Fresa',
        '10'=>'Marmelada_Naranja',
        '11'=>'Marmelada_Durazno',
        '12'=>'Marmelada_Durazno',
        '13'=>'Marmelada_Durazno',
        '14'=>'Sables_Bretons',
        '15'=>'Meringues',
        '16'=>"Confits_Oigons",
        '17'=>'Tapenade',
        '18'=>"Caviar_Aubergines",
        '19'=>"Moutarde",
        
        // Traiteur
        '20'=>"Empanadas",
        '21'=>"Cake_Olives_Lardons"
        );

    $flavours_Element = array(
        // Embutidos
        '1'=>'',
        '2'=>'',
        
        // Patés
        '3'=>'',
        '4'=>'',
        '5'=>'',
        
        // Jamones
        '6'=>'',
        '7'=>'',

        // Epicerie fine
        '8'=>'Limón',
        '9'=>'Fresa',
        '10'=>'Naranja',
        '11'=>'Durazno',
        '12'=>'Manguo Limón',
        '13'=>'Manzana Uva',
        '14'=>'',
        '15'=>'',
        '16'=>'',
        '17'=>'',
        '18'=>'',
        '19'=>'',
        
        // Traiteur
        '20'=>'',
        '21'=>''
        );

    $biscuits_Element = array(
        // Embutidos
        '1'=>'',
        '2'=>'',
        
        // Patés
        '3'=>'',
        '4'=>'',
        '5'=>'',
        
        // Jamones
        '6'=>'',
        '7'=>'',

        // Epicerie fine
        '8'=>'',
        '9'=>'',
        '10'=>'',
        '11'=>'',
        '12'=>'',
        '13'=>'',
        '14'=>'Sables',
        '15'=>'Meringues',
        '16'=>'',
        '17'=>'',
        '18'=>'',
        '19'=>'',
        
        // Traiteur
        '20'=>'',
        '21'=>''
        );
    
    $categories_Element = array(
        // Embutidos
        '1'=>'Embutidos',
        '2'=>'Embutidos',
        
        // Pates
        '3'=>'Pates',
        '4'=>'Pates',
        '5'=>'Pates',
        
        // Jamones
        '6'=>'Jamones',
        '7'=>'Jamones',

        // Epicerie fine
        '8'=>'Epicerie fine',
        '9'=>'Epicerie fine',
        '10'=>'Epicerie fine',
        '11'=>'Epicerie fine',
        '12'=>'Epicerie fine',
        '13'=>'Epicerie fine',
        '14'=>'Epicerie fine',
        '15'=>'Epicerie fine',
        '16'=>'Epicerie fine',
        '17'=>'Epicerie fine',
        '18'=>'Epicerie fine',
        '19'=>'Epicerie fine',
        
        // Traiteur
        '20'=>'Traiteur',
        '21'=>'Traiteur'
        );

    $natural_Element = array(
        // Embutidos
        '1'=> true,
        '2'=> true,
        
        // Pates
        '3'=> true,
        '4'=> true,
        '5'=> true,
        
        // Jamones
        '6'=> true,
        '7'=> true,

        // Epicerie_fine
        '8'=> false,
        '9'=> false,
        '10'=> false,
        '11'=> false,
        '12'=> false,
        '13'=> false,
        '14'=> false,
        '15'=> false,
        '16'=> false,
        '17'=> false,
        '18'=> false,
        '19'=> false,
        
        // Traiteur
        '20'=> false,
        '21'=> false
        );

    $types_alt = array(
        // Embutidos
        '1'=>'1.png',
        '2'=>'2.png',
        
        // Patés
        '3'=>'3.png',
        '4'=>'4.png',
        '5'=>'5.png',
        
        // Jamones
        '6'=>'6.png',
        '7'=>'7.png',

        // Epicerie fine
        '8'=>'8.png',
        '9'=>'9.png',
        '10'=>'10.png',
        '11'=>'11.png',
        '12'=>'12.png',
        '13'=>'13.png',
        '14'=>'14.png',
        '15'=>'15.png',
        '16'=>'16.png',
        '17'=>'17.png',
        '18'=>'18.png',
        '19'=>'19.png',
        
        // Traiteur
        '20'=>'20.png',
        '21'=>'21.png'
        );

    // Combining
    for ($i=1; $i < 22; $i++) { 
        $Element = new Element();
        $Element->setName($names_Element[$i]);
        $Element->setDescription($descriptions_Element[$i]);
        $Element->setPrice($prices_Element[$i]);
        $Element->setQuantity($quantities_Element[$i]);
        $Element->setWeight($weights_Element[$i]);
        $Element->setType($types_Element[$i]);
        $Element->setFlavour($flavours_Element[$i]);
        $Element->setBiscuit($biscuits_Element[$i]);
        $Element->setCategory($categories_Element[$i]);
        $Element->setNaturalProduct($natural_Element[$i]);
        $Element->setUnit($units_Element[$i]);
        $Element->setUrl('png');
        $Element->setAlt($types_alt[$i]);
        $manager->persist($Element);
    }    
    
    // Saving
    $manager->flush();
  }
}