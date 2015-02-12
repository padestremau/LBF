<?php

namespace LBF\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function addToCartAction()
    {

        $request = Request::createFromGlobals();
        $cart = json_decode($request->cookies->get('sessionCart'), true);

        // Système de session pour éviter de créer des comptes.
        $session = $this->getRequest()->getSession();
        $sessionCart = $session->get('cart');
        if ($session and $sessionCart) {
            // Si oui, On continue
        }
        else {
            // Sinon, On crée d'abord la session
            $IP_user = $this->container->get('request')->getClientIp();
            $session->set('IP', $IP_user);
            $session->set('cart',array());

            $sessionCart = array();
        }

        // On vérifie que l'élément est bien un produit proposé
        $allProducts = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findAll();

        for ($i=0; $i < sizeof($cart); $i++) { 
            $single_el = $cart[$i];
            for ($j=0; $j < sizeof($allProducts); $j++) { 
                $typeAvailable = $allProducts[$j];
                if ($typeAvailable->getType() == $single_el['type']) {
                    for ($k=0; $k < sizeof($sessionCart); $k++) { 
                        if ($sessionCart[$k]['item'] == $typeAvailable) {
                            $new_qty = $single_el['qty'] + $sessionCart[$i]['qty'];
                            $sessionCart[$i] = array('item' => $typeAvailable, 'qty' => $new_qty);
                            break;
                        }
                    }
                    $sessionCart[$i] = array('item' => $typeAvailable, 'qty' => $single_el['qty']);
                    break;
                }
            }
        }
        $session->set('cart', $sessionCart);   

        return $this->redirect($this->generateUrl('lbf_main_cart'));
    }

    public function deleteFromCartAction ($type)
    {
        // Système de session pour éviter de créer des comptes.
        $session = $this->getRequest()->getSession();
        $sessionCart = $session->get('cart');
        if ($session and $sessionCart) {
            // Si oui, On continue
        }
        else {
            // Sinon, On crée d'abord la session
            $IP_user = $this->container->get('request')->getClientIp();
            $session->set('IP', $IP_user);
            $session->set('cart',array());

            $sessionCart = array();
        }

        for ($i=0; $i < sizeof($sessionCart); $i++) { 
            $cart_el = $sessionCart[$i];
            if ($cart_el['item']->getType() == $type) {
                array_splice($sessionCart, $i, 1);
                break;
            }
        }
        $session->set('cart', $sessionCart);   

        return $this->redirect($this->generateUrl('lbf_main_cart'));   
    }

    public function myCartAction()
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

        return $this->render('LBFMainBundle:Main:cart.html.twig', array(
            'cart' => $cart
        ));
    }

    public function emptyCartAction()
    {
        // Système de session pour éviter de créer des comptes.
        $session = $this->getRequest()->getSession();
        if ($session) {
            $session->clear('cart');
        }

        return $this->redirect($this->generateUrl('lbf_main_homepage'));
    }
}
