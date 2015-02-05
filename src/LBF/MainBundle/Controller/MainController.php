<?php

namespace LBF\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
    	$allProducts = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findAll();

        $allEmbutidos = array();
        $allPates = array();
        $allJamones = array();
        $allEpicerieFine = array();
        for ($i=0; $i < sizeof($allProducts); $i++) { 
        	$product = $allProducts[$i];
        	if ($product->getCategory() == 'Embutidos') {
        		$allEmbutidos[] = $product;
        	}

        	else if ($product->getCategory() == 'Pates') {
        		$allPates[] = $product;
        	}

        	else if ($product->getCategory() == 'Jamones') {
        		$allJamones[] = $product;
        	}

        	else if ($product->getCategory() == 'Epicerie fine') {
        		$allEpicerieFine[] = $product;
        	}

        }
        $allCategories = array(
        	'1' => 'Embutidos', 
        	'2' => 'Pates',
        	'3' => 'Jamones',
        	'4' => 'Epicerie fine'
        );
        $allSortedProducts = array(
        	'1' => $allEmbutidos,
        	'2' => $allPates,
			'3' => $allJamones,
			'4' => $allEpicerieFine
        	);

        return $this->render('LBFMainBundle:Main:indexMain.html.twig', array(
        	'allEmbutidos' => $allEmbutidos,
        	'allPates' => $allPates,
			'allJamones' => $allJamones,
			'allEpicerieFine' => $allEpicerieFine,
        	'allProducts' => $allProducts,
        	'allCategories' => $allCategories,
			'allSortedProducts' => $allSortedProducts
        	));
    }
}
