<?php

namespace LBF\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use LBF\UserBundle\Form\OrdersType;
use LBF\UserBundle\Entity\Orders;
use LBF\MainBundle\Entity\NewsletterEmail;

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

    public function newsletterEmailAction($path)
    {
        $allMails = $this ->getDoctrine()
                                ->getManager()
                                ->getRepository('LBFMainBundle:NewsletterEmail')
                                ->findAll();

        $newsletterEmail = new NewsletterEmail;
        $email = stripslashes($_POST['newsletterEmail']);
        $newsletterEmail->setEmail($email);

        $decision = 'YES';
        for ($i=0; $i < sizeof($allMails); $i++) { 
            if ($allMails[$i]->getEmail() == $email) {
                $decision = 'NO';
            }
        }
        if ($decision == 'YES') {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletterEmail);
            $em->flush();
        }

        if (sizeof($path) > 0) {
            return $this->redirect($this->generateUrl($path));
        }

        return $this->redirect($this->generateUrl('lbf_main_homepage'));
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

        $allProducts = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findAll();

        return $this->render('LBFMainBundle:Main:cart.html.twig', array(
            'cart' => $cart,
            'allProducts' => $allProducts
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

    public function orderAction() 
    {

        /* Current User */
        $currentUser = $this->getUser();

        // Système de session pour éviter de créer des comptes.
        $session = $this->getRequest()->getSession();
        $cart = $session->get('cart');

        $newOrder = new Orders();
        $newOrder->setUser($currentUser);
        $newOrder->setElements($cart);
        $newOrder->setDeliveryAt(new \DateTime());

        // On utiliser le OrdersType
        $formNewOrder = $this->createForm(new OrdersType(), $newOrder);

        // On récupère la requête
        $formNewOrder->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formNewOrder->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newOrder);

            // Message for client
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('[Le Buffet Francés] New order on hold.')
                ->setFrom(array('contact@lebuffetfrances.com' => 'Le Buffet Francés'))
                ->setTo($currentUser->getEmail())
                ->setBody(
                    $this->renderView('LBFUserBundle:User:emailConfirmation.html.twig',
                        array(  'newOrder' => $newOrder,
                                'member' => $currentUser)
                    )
                )
            ;

            $this->get('mailer')->send($message);


            // Message for manager/admin
            $messageAdmin = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('[Le Buffet Francés] Nouvelle commande.')
                ->setFrom(array('contact@lebuffetfrances.com' => 'Le Buffet Francés'))
                ->setTo('p.a.destremau@gmail.com')
                ->setBody(
                    $this->renderView('LBFUserBundle:User:emailAdmin.html.twig',
                        array(  'newOrder' => $newOrder,
                                'member' => $currentUser)
                    )
                )
            ;

            $this->get('mailer')->send($messageAdmin);

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('lbf_main_empty_special'));
        }

        return $this->render('LBFMainBundle:Main:order.html.twig', array(
            'formNewOrder' => $formNewOrder->createView(),
            'cart' => $cart
        ));
    }


    public function emptySpecialAction()
    {
        // Système de session pour éviter de créer des comptes.
        $session = $this->getRequest()->getSession();
        $session->clear('cart');

        return $this->redirect($this->generateUrl('lbf_main_confirm'));
    }

    public function confirmAction() {
        
        return $this->render('LBFMainBundle:Main:confirm.html.twig');
    }
}
