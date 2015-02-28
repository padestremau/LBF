<?php
// src/LBF/MainBundle/DataFixtures/ORM/ElementFixtures.php

namespace LBF\MainBundle\DataFixtures\ORM;

use LBF\MainBundle\Entity\Element;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use LBF\MainBundle\Entity\Recipe;

class ElementFixtures implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {




    //  ---------------------------------------------- For Elements ------------------------------------------------



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
        '6'=>'Jamon_Paris',
        '7'=>'Lardons',

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
    $allProducts = array();
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

        $allProducts[] = $Element;

        $manager->persist($Element);
    }



    //  ---------------------------------------------- For Recipes ------------------------------------------------

    // Chorizo de Cerdo
    $chorizo_cerdo = '';
    for ($i=0; $i < sizeof($allProducts); $i++) { 
        if ($allProducts[$i]->getType() == "Chorizo_de_cerdo") {
            $chorizo_cerdo = $allProducts[$i];
            break;
        }
    }

    // Jambon
    $jambon_paris = '';
    for ($i=0; $i < sizeof($allProducts); $i++) { 
        if ($allProducts[$i]->getType() == "Jamon_Paris") {
            $jambon_paris = $allProducts[$i];
            break;
        }
    }

    // Lardons
    $lardons = '';
    for ($i=0; $i < sizeof($allProducts); $i++) { 
        if ($allProducts[$i]->getType() == "Lardons") {
            $lardons = $allProducts[$i];
            break;
        }
    }

    $titles_Recipe = array(
        // Embutidos
        '1'=>'Rougail de saucisses',
        '2'=>'Saucisses aux lentilles',
        '3'=>'Cassoulet',

        // Jambons
        '4'=>'Roulés au jambon',
        '5'=>'Croquetas de jambon',
        '6'=>'Pâtes à la carbonara',
        '7'=>'Quiche lorraine',
        '8'=>'Salade aux lardons'
        );

    $elements_Recipe = array(
        // Embutidos
        '1'=> $chorizo_cerdo,
        '2'=> $chorizo_cerdo,
        '3'=> $chorizo_cerdo,

        // Jambons
        '4'=> $jambon_paris,
        '5'=> $jambon_paris,
        '6'=> $lardons,
        '7'=> $lardons,
        '8'=> $lardons
        );
        
        
    $duration_Recipe = array(
        // Embutidos
        '1'=>'20',
        '2'=>'10',
        '3'=>'30',

        // Jambons
        '4'=>'15',
        '5'=>'20',
        '6'=>'15',
        '7'=>'20',
        '8'=>'20'
        );
    
    $forHowMany_Recipe = array(
        // Embutidos
        '1'=>'4',
        '2'=>'4',
        '3'=>'6',

        // Jambons
        '4'=>'4',
        '5'=>'4',
        '6'=>'4',
        '7'=>'4',
        '8'=>'6'
        );

    
    $cooking_Recipe = array(
        // Embutidos
        '1'=>'25',
        '2'=>'25',
        '3'=>'300',

        // Jambons
        '4'=>'0',
        '5'=>'25',
        '6'=>'15',
        '7'=>'50',
        '8'=>'50'
        );

    $origin_Recipe = array(
        // Embutidos
        '1'=>'Ile Maurice (France)',
        '2'=>'France',
        '3'=>'France',

        // Jambons
        '4'=>'France',
        '5'=>'Espagne',
        '6'=>'À la française',
        '7'=>'France',
        '8'=>'France'
        );

    $ingredients_Recipe = array(
        // Embutidos
        '1'=> array( "4 chorizos de cerdo", "4 tomates", "4 oignons", "4 gousses d’ail", "Thym, laurier", "Sel, poivre", "1 cuillère à café de curcuma ", "4g de gingembre", "1 petit rocoto", "huile végétale"),
        '2'=> array("4 chorizos de cerdo","200g de lardons ","300g de lentilles ","2 carottes","2 oignons","2 gousses d’ail ","Thym, laurier","Sel, poivre","huile végétale"),
        '3'=> array("6 chorizos de cerdo","300g de lardons","6 cuisses de canard","800g de haricots blancs ","1 carotte","1 oignon","4 gousses d’ail","Clou de girofle","Thym, laurier","Sel, poivre","huile végétale"),

        // Jambons
        '4'=> array("4 tranches de jambon de Paris","150g de fromage frais à tartiner ","Persil"),
        '5'=> array(),
        '6'=> array("500g de spaghetti","50cl de crème fraîche ","3 jaunes d’oeufs","Sel, poivre noir","300g de lardons"),
        '7'=> array(array("title" => "Pour la pâte brisée :", "250g de farine", "125g de beurre mou ", "1 jaunes d’oeufs", "5cl d’eau"), array("title" => "Pour la garniture :","250g de lardons","3 oeufs","20cl de crème de lait ","20cl de lait","Sel, poivre","Muscade")),
        '8'=> array("300g de lardons ","1 salade verte","4 tomates","3 oeufs","Huile","Vinaigre de vin ","Moutarde","Sel et poivre")
        );


    $preparation_Recipe = array(
        // Embutidos
        '1'=>array("Faire dorer les chorizos avec un filet d’huile à la poêle pendant 5 minutes et laisser refroidir dans une assiette.","Faire chauffer de l’huile dans la même poêle.","Y faire revenir les oignons émincés, l’ail écrasé et le gingembre rapé quelques instants à feu doux.","Une fois refroidies, couper les saucisses en tronçons puis les faire revenir avec les oignons. Après 5 minutes, ajouter les tomates coupées en petits morceaux et les aromates (curcuma, rocoto, sel, poivre, thym et laurier).","Mélanger le tout, ajouter un petit verre d’eau puis laisser mijoter à feu doux pendant environ 10 à 15 minutes en ôtant le couvercle de temps à autre pour éliminer l’excès d’eau.","Servir avec du riz et des lentilles."),
        '2'=>array("Faire dorer les chorizos avec un filet d’huile à la cocote minute pendant 5 minutes.","Ajouter les lardons, les oignons émincés, l’ail en morceaux et les carottes en rondelles.","Faire légèrement colorer 5 minutes.","Ajouter les lentilles, 1 litre d’eau, le thym et le laurier, poivrer.","Fermer la cocotte minute et laisser cuire 15 min dès la mise en rotation de la soupape.","Saler et ajouter de la moutarde.","Cette recette est encore meilleure le lendemain réchauffée."),
        '3'=>array("Faire tremper les haricots la veille.","Plonger dans l’eau bouillante 1 minute les haricots, l’oignon pelé et piqué de 3 clous de girofle, la carotte coupée en rondelles, le thym et le laurier.","Se débarasser de l’eau. Recouvrir d’eau froide et porter à ébulition. Continuer à petit feu pendant 1 heure. Ecumer si besoin.","Pendant ce temps tapisser le fond d’un plat allant au four avec la couenne coupée en morceau (gras côté plat) et frotter les parois de la cocotte avec l’ail.","Faire dorer la saucisse et les cuisses de canard d’un seul côté dans de la graisse de canard. Verser dans le fond du plat les haricots et les lardons.","Saler et poivrer. Ajouter de l’ail écrasé et 3 louches de bouillon (eau dans laquelle a ont cuit les haricots).","Enfourner à 165°C (thermostat 5-6) pendant environ 4 heures à découvert.","Toutes les 30 minutes, arroser avec le jus de cuisson, si le plat se dessèche rajouter de l’eau.","A 3h30 de cuisson, ajouter les cuisses de canard dans les haricots et disposer les saucisse sur le dessus du plat.","L’idéal est de faire ce plat la veille pour le lendemain. C’est encore meilleur !"),

        // Jambons
        '4'=>array("Mélanger le persil au fromage frais.","Etaler ce mélange sur chaque tranche de jambon. Rouler celles-ci et coupez les en tronçons pour en faire de petites bouchées.","Servir frais piqué d’un batonnet de bois et accompagné de petite tomates cerises."),
        '5'=>array(),
        '6'=>array("Faire cuire les pâtes.","Faire revenir les lardons à la poêle.","Battre dans un saladier la crème fraîche, les oeufs, le sel le poivre.","Retirer les lardons du feu dés qu’ils sont dorés et les ajouter à la crème.","Récupérer 2 cuillères à soupe d’eau de cuisson des pâtes.","Une fois les pâtes cuite al dente, les égoutter et y incorporer la crème.","Saupoudrer de fromage rapé et de basilic."),
        '7'=>array(array("title" => "La pâte brisée :", "Dans un saladier, mélangez la farine, le beurre en morceaux, le jaune d’œuf et 5cl d’eau. ", "Formez une boule, enveloppez-la dans du film alimentaire et mettez-la au réfrigérateur au moins 2 heures. ", "Sortez la pâte du réfrigérateur au moins 15mn avant de l’étaler, puis farinez votre plan de travail et étalez la pâte au rouleau."), array("title" => "La garniture :",  "Etaler la pâte dans un moule, piquer à la fourchette.", "Faire rissoler les lardons à la poêle puis les répartir sur le fond de pâte.", "Battre les oeufs, la crème fraîche et le lait, assaisonner avec le sel, le poivre et la muscade. Verser sur la pâte.", "Faire cuire 45 à 50 min au four à 180°C (thermostat 6).")),
        '8'=>array("Nettoyer la salade.","Faire revenir les lardons à la poêle.","Plongez les oeufs dans l’eau froide et porter à ébulition pendant 10 minutes.","Faire une vinaigrette.","Mélanger le tout avec les tomates.", array("title" => "Sauce vinaigrette :", "Mélanger 1 dose de vinaigre avec 3 doses d’huile.","Ajouter de la moutarde, du sel et poivre. ","Mélanger vigoureusement."))
        );
    
    $description_Recipe = array(
        // Embutidos
        '1'=>'Rougail de saucisses - à développer',
        '2'=>'Saucisses aux lentilles - à développer',
        '3'=>'Cassoulet - à développer',

        // Jambons
        '4'=>'Roulés au jambon - à développer',
        '5'=>'Croquetas de jambon - à développer',
        '6'=>'Pâtes à la carbonara - à développer',
        '7'=>'Quiche lorraine - à développer',
        '8'=>'Salade aux lardons - à développer'
        );

    $recipes_alt = array(
        // Embutidos
        '1'=>'1.jpg',
        '2'=>'2.jpg',
        '3'=>'3.jpg',

        // Jambons
        '4'=>'4.jpg',
        '5'=>'5.jpg',
        '6'=>'6.jpg',
        '7'=>'7.jpg',
        '8'=>'8.jpg'
        );

    // Combining
    for ($i=1; $i < (sizeof($titles_Recipe) + 1); $i++) { 
        $Recipe = new Recipe();
        $Recipe->setTitle($titles_Recipe[$i]);
        $Recipe->setElement($elements_Recipe[$i]);
        $Recipe->setDuration($duration_Recipe[$i]);
        $Recipe->setForHowMany($forHowMany_Recipe[$i]);
        $Recipe->setCooking($cooking_Recipe[$i]);
        $Recipe->setOrigin($origin_Recipe[$i]);
        $Recipe->setIngredients($ingredients_Recipe[$i]);
        $Recipe->setPreparation($preparation_Recipe[$i]);
        $Recipe->setDescription($description_Recipe[$i]);
        $Recipe->setUrl('jpg');
        $Recipe->setAlt($recipes_alt[$i]);
        $manager->persist($Recipe);
    }
    
    // Saving
    $manager->flush();
  }
}