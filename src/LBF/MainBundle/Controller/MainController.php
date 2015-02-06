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

    public function addToCartAction($type, $quantity)
    {
        // Système de session pour éviter de créer des comptes.
        $session = $this->getRequest()->getSession();
        $cart = $session->get('cart');
        if ($session and $cart) {
            // Si oui, On continue
        }
        else {
            // Sinon, On crée d'abord la session
            $IP_user = $this->container->get('request')->getClientIp();
            $session->set('IP', $IP_user);
            $session->set('cart',array());
        }

        // On vérifie que l'élément est bien un produit proposé
        $allProducts = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findAll();

        $typeAvailable = '';
        $proceed = 'NO';
        for ($i=0; $i < sizeof($allProducts); $i++) { 
            $checking = $allProducts[$i];
            if ($checking->getType() == $type) {
                $proceed = 'YES';
                $typeAvailable = $checking;
            }
        }


        // Si oui, on l'ajoute au panier
        if ($proceed == 'YES') {
            // Vérifier si les éléments sont disponibles 
            if ($typeAvailable->getQuantity() > 0) {
                if (sizeof($cart) > 0) {
                    $validator = 'NO';
                    for ($i=0; $i < sizeof($cart); $i++) { 
                        $inCart = $cart[$i];
                        $item_s = $inCart['item'];
                        if ($item_s->getType() == $typeAvailable->getType()) {
                            $newQty = $inCart['qty'];
                            if ($newQty <= $typeAvailable->getQuantity()) {
                                $newQty = $inCart['qty'] + $quantity ;
                                $cart[$i] = array('item' => $typeAvailable, 'qty' => $newQty);
                                $validator = 'YES';
                            }
                            else {
                                $session->set('exceed', 'Sorry, there are only '.$quantity.' elements left in stock');
                            }
                            break;
                        }
                    }
                    if ($validator == 'NO') {
                        $cart[] = array('item' => $typeAvailable, 'qty' => $quantity);
                    }
                }
                else {
                    $cart[] = array('item' => $typeAvailable, 'qty' => $quantity);
                }
                $session->set('cart', $cart);
            }
            else {
                $session->set('exceed', 'Sorry, no more of these items in stock');
            }
        }

        return $this->redirect($this->generateUrl('lbf_main_homepage').'#ourProducts');
    }

    public function emptyCartAction()
    {
        // Système de session pour éviter de créer des comptes.
        $session = $this->getRequest()->getSession();
        if ($session) {
            $session->clear('cart');

        }
        session_destroy();
        return $this->redirect($this->generateUrl('lbf_main_homepage'));
    }
}
