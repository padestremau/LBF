<?php
// src/LBF/MainBundle/DataFixtures/ORM/RecipeFixtures.php

namespace LBF\MainBundle\DataFixtures\ORM;

use LBF\MainBundle\Entity\Recipe;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class RecipeFixtures implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $names_Recipe = array(
        // Embutidos
        '1'=>'Chorizo de cerdo',
        '2'=>'Chorizo verde',
        '3'=>'Salchicha merguez',
        '4'=>'Saucisse sèche',
        '5'=>'Saucisson',
        '6'=>'Salami',
        
        // Patés
        '7'=>'Paté de foie al pisco',
        '8'=>'Terrine de campagne',
        '9'=>'Paté al chuño',
        '10'=>'Rillettes de porc',
        
        // Jamones
        '11'=>'Jambon de Paris',
        '12'=>'Lardons',

        // Epicerie fine
        '13'=>'Marmelada Limón',
        '14'=>'Marmelada Fresa',
        '15'=>'Marmelada Naranja',
        '16'=>'Marmelada Durazno',
        '17'=>'Marmelada Sauco',
        '18'=>'Marmelada Aguaymanto',
        '19'=>'Confitura de vino',
        '20'=>'Confitura de cebolla',
        '21'=>'Vino de naranja',
        '22'=>'Limoncello'
        );
        
        
    $descriptions_Recipe = array(
        // Embutidos
        '1'=>'Différentes parties du cochon relevées par un savant mélange d’épices. Tous les ingrédients utilisés sont frais.',
        '2'=>'Différentes parties du cochon auxquelles sont ajouté un mélange de légumes, blettes et épinards. Tous les ingrédients utilisés sont frais.',
        '3'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '4'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '5'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '6'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        
        // Patés
        '7'=>'Foie de volaille cuisinés au vin blanc et relevé au Pisco. Tous les ingrédients utilisés sont frais.',
        '8'=>'Différentes viandes (bœuf et porc) cuisinées avec un savant mélange d’épices et relevé au Pisco. Tous les ingrédients utilisés sont frais.',
        '9'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '10'=>'Poitrine de porc cuisinée selon un processus long et délicat. Tous les ingrédients utilisés sont frais.',
        
        // Jamones
        '11'=>'Jambe de porc sélectionné salé en saumure parfumée et cuit en moule au four. Tous les ingrédients utilisés sont frais.',
        '12'=>'Poitrine de porc salée et saumurée coupée à la française. Tous les ingrédients utilisés sont frais.',

        // Epicerie fine
        '13'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '14'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '15'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '16'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '17'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '18'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '19'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '20'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '21'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.',
        '22'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quo assumenda distinctio eos voluptas laudantium est non dolor porro aspernatur. Voluptate dignissimos, error laborum aliquam nisi sunt vel rem corporis.'
        );
    
    $prices_Recipe = array(
        // Embutidos
        '1'=>'20',
        '2'=>'25',
        '3'=>'15',
        '4'=>'15',
        '5'=>'20',
        '6'=>'10',
        
        // Patés
        '7'=>'30',
        '8'=>'35',
        '9'=>'30',
        '10'=>'25',
        
        // Jamones
        '11'=>'20',
        '12'=>'20',

        // Epicerie fine
        '13'=>'15',
        '14'=>'15',
        '15'=>'15',
        '16'=>'15',
        '17'=>'15',
        '18'=>'15',
        '19'=>'20',
        '20'=>'20',
        '21'=>'35',
        '22'=>'35'
        );

    
    $quantities_Recipe = array(
        // Embutidos
        '1'=>'5',
        '2'=>'8',
        '3'=>'50',
        '4'=>'60',
        '5'=>'12',
        '6'=>'15',
        
        // Patés
        '7'=>'9',
        '8'=>'10',
        '9'=>'8',
        '10'=>'5',
        
        // Jamones
        '11'=>'100',
        '12'=>'120',

        // Epicerie fine
        '13'=>'6',
        '14'=>'8',
        '15'=>'9',
        '16'=>'4',
        '17'=>'3',
        '18'=>'5',
        '19'=>'11',
        '20'=>'15',
        '21'=>'3',
        '22'=>'5'
        );

    $weights_Recipe = array(
        // Embutidos
        '1'=>'200',
        '2'=>'250',
        '3'=>'40',
        '4'=>'45',
        '5'=>'180',
        '6'=>'50',
        
        // Patés
        '7'=>'400',
        '8'=>'700',
        '9'=>'500',
        '10'=>'400',
        
        // Jamones
        '11'=>'20', // 10 tranches !
        '12'=>'20',  // 10 tranches !

        // Epicerie fine
        '13'=>'300',
        '14'=>'300',
        '15'=>'300',
        '16'=>'300',
        '17'=>'300',
        '18'=>'300',
        '19'=>'250',
        '20'=>'250',
        '21'=>'400',
        '22'=>'300'
        );

    $types_Recipe = array(
        // Embutidos
        '1'=>'Chorizo_de_cerdo',
        '2'=>'Chorizo_verde',
        '3'=>'Salchicha_merguez',
        '4'=>'Saucisse_seche',
        '5'=>'Saucisson',
        '6'=>'Salami',
        
        // Patés
        '7'=>'Pate_de_foie_al_pisco',
        '8'=>'Terrine_de_campagne',
        '9'=>'Pate_al_chuno',
        '10'=>'Rillettes_de_porc',
        
        // Jamones
        '11'=>'Jamon_frances',
        '12'=>'Jamon_serano',

        // Epicerie fine
        '13'=>'Marmelada_Limon',
        '14'=>'Marmelada_Fresa',
        '15'=>'Marmelada_Naranja',
        '16'=>'Marmelada_Durazno',
        '17'=>'Marmelada_Sauco',
        '18'=>'Marmelada_Aguaymanto',
        '19'=>'Confitura_de_vino',
        '20'=>'Confitura_de_cebolla',
        '21'=>'Vino_de_naranja',
        '22'=>'Limoncello'
        );

    $flavours_Recipe = array(
        // Embutidos
        '1'=>'',
        '2'=>'',
        '3'=>'',
        '4'=>'',
        '5'=>'',
        '6'=>'',
        
        // Patés
        '7'=>'',
        '8'=>'',
        '9'=>'',
        '10'=>'',
        
        // Jamones
        '11'=>'',
        '12'=>'',

        // Epicerie fine
        '13'=>'Limón',
        '14'=>'Fresa',
        '15'=>'Naranja',
        '16'=>'Durazno',
        '17'=>'Sauco',
        '18'=>'Aguaymanto',
        '19'=>'Vino',
        '20'=>'Cebolla',
        '21'=>'',
        '22'=>''
        );
    
    $categories_Recipe = array(
        // Embutidos
        '1'=>'Embutidos',
        '2'=>'Embutidos',
        '3'=>'Embutidos',
        '4'=>'Embutidos',
        '5'=>'Embutidos',
        '6'=>'Embutidos',
        
        // Pates
        '7'=>'Pates',
        '8'=>'Pates',
        '9'=>'Pates',
        '10'=>'Pates',
        
        // Jamones
        '11'=>'Jamones',
        '12'=>'Jamones',

        // Epicerie fine
        '13'=>'Epicerie fine',
        '14'=>'Epicerie fine',
        '15'=>'Epicerie fine',
        '16'=>'Epicerie fine',
        '17'=>'Epicerie fine',
        '18'=>'Epicerie fine',
        '19'=>'Epicerie fine',
        '20'=>'Epicerie fine',
        '21'=>'Epicerie fine',
        '22'=>'Epicerie fine'
        );

    $natural_Recipe = array(
        // Embutidos
        '1'=> true,
        '2'=> true,
        '3'=> true,
        '4'=> true,
        '5'=> true,
        '6'=> true,
        
        // Pates
        '7'=> true,
        '8'=> true,
        '9'=> false,
        '10'=> true,
        
        // Jamones
        '11'=> true,
        '12'=> true,

        // Epicerie_fine
        '13'=> false,
        '14'=> false,
        '15'=> false,
        '16'=> false,
        '17'=> false,
        '18'=> false,
        '19'=> false,
        '20'=> false,
        '21'=> false,
        '22'=> false
        );

    $types_alt = array(
        // Embutidos
        '1'=>'1.png',
        '2'=>'2.png',
        '3'=>'3.png',
        '4'=>'4.png',
        '5'=>'5.png',
        '6'=>'6.png',
        
        // Patés
        '7'=>'7.png',
        '8'=>'8.png',
        '9'=>'9.png',
        '10'=>'10.png',
        
        // Jamones
        '11'=>'11.png',
        '12'=>'12.png',

        // Epicerie fine
        '13'=>'13.png',
        '14'=>'14.png',
        '15'=>'15.png',
        '16'=>'16.png',
        '17'=>'17.png',
        '18'=>'18.png',
        '19'=>'19.png',
        '20'=>'20.png',
        '21'=>'21.png',
        '22'=>'22.png'
        );

    // Combining
    for ($i=1; $i < 23; $i++) { 
        $Recipe = new Recipe();
        $Recipe->setName($names_Recipe[$i]);
        $Recipe->setDescription($descriptions_Recipe[$i]);
        $Recipe->setPrice($prices_Recipe[$i]);
        $Recipe->setQuantity($quantities_Recipe[$i]);
        $Recipe->setWeight($weights_Recipe[$i]);
        $Recipe->setType($types_Recipe[$i]);
        $Recipe->setFlavour($flavours_Recipe[$i]);
        $Recipe->setCategory($categories_Recipe[$i]);
        $Recipe->setNaturalProduct($natural_Recipe[$i]);
        $Recipe->setUrl('png');
        $Recipe->setAlt($types_alt[$i]);
        $manager->persist($Recipe);
    }    
    
    // Saving
    $manager->flush();
  }
}