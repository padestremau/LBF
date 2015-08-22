<?php

namespace LBF\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use LBF\UserBundle\Form\OrdersType;
use LBF\UserBundle\Entity\Orders;
use LBF\MainBundle\Entity\NewsletterEmail;
use LBF\MainBundle\Entity\Testimony;
use LBF\MainBundle\Form\TestimonyType;

class MainController extends Controller
{
    public function indexAction()
    {
    	$allProducts = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findBy(['active' => array('active', 'new', 'toCome', 'soldOut')], ['orderList' => 'ASC']);

        $allPanVino = array();
        $allBufSalado = array();
        $allEmbutidos = array();
        $allBufDulce = array();
        $allMermeladas = array();
        for ($i=0; $i < sizeof($allProducts); $i++) { 
        	$product = $allProducts[$i];
        	if ($product->getCategory() == 1) {
        		$allPanVino[] = $product;
        	}

        	else if ($product->getCategory() == 2) {
        		$allBufSalado[] = $product;
        	}

        	else if ($product->getCategory() == 3) {
        		$allEmbutidos[] = $product;
        	}

        	else if ($product->getCategory() == 4) {
                $allBufDulce[] = $product;
        	}

            else if ($product->getCategory() == 5) {
                $allMermeladas[] = $product;
            }

        }

        $allRecipes = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Recipe')
                            ->findAll();

        $recipesPanVino = array();
        $recipesBufSalado = array();
        $recipesEmbutidos = array();
        $recipesBufDulce = array();
        $recipesMermeladas = array();
        for ($i=0; $i < sizeof($allRecipes); $i++) { 
            $recipe = $allRecipes[$i];
            if ($recipe->getElement()->getCategory() == 1) {
                $recipesPanVino[] = $recipe;
            }

            else if ($recipe->getElement()->getCategory() == 2) {
                $recipesBufSalado[] = $recipe;
            }

            else if ($recipe->getElement()->getCategory() == 3) {
                $recipesEmbutidos[] = $recipe;
            }

            else if ($recipe->getElement()->getCategory() == 4) {
                $recipesBufDulce[] = $recipe;
            }

            else if ($recipe->getElement()->getCategory() == 5) {
                $recipesMermeladas[] = $recipe;
            }

        }


        $allCategories = array(
        	'1' => 1, 
        	'2' => 2,
        	'3' => 3,
        	'4' => 4,
            '5' => 5
        );
        $allSortedProducts = array(
        	'1' => $allPanVino,
        	'2' => $allBufSalado,
			'3' => $allEmbutidos,
			'4' => $allBufDulce,
            '5' => $allMermeladas
        	);

        $allSortedRecipes = array(
            '1' => $recipesPanVino,
            '2' => $recipesBufSalado,
            '3' => $recipesEmbutidos,
            '4' => $recipesBufDulce,
            '5' => $recipesMermeladas
            );

        $testimonies = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Testimony')
                            ->findAll();

        $pages = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Page')
                            ->findAll();

        $creators = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Member')
                            ->findAll();

        $homePhotos = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:HomePhoto')
                            ->findAll();

        return $this->render('LBFMainBundle:Main:indexMain.html.twig', array(
        	'allPanVino' => $allPanVino,
        	'allBufSalado' => $allBufSalado,
			'allEmbutidos' => $allEmbutidos,
			'allBufDulce' => $allBufDulce,
        	'allProducts' => $allProducts,
        	'allCategories' => $allCategories,
            'allMermeladas' => $allMermeladas,
            'allProducts' => $allProducts,
            'allSortedProducts' => $allSortedProducts,
            'recipesPanVino' => $recipesPanVino,
            'recipesBufSalado' => $recipesBufSalado,
            'recipesEmbutidos' => $recipesEmbutidos,
            'recipesBufDulce' => $recipesBufDulce,
            'recipesMermeladas' => $recipesMermeladas,
            'allRecipes' => $allRecipes,
			'allSortedRecipes' => $allSortedRecipes,
            'testimonies' => $testimonies,
            'pages' => $pages,
            'creators' => $creators,
            'homePhotos' => $homePhotos
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
        $type = stripslashes($_POST['newsletterType']);
        $newsletterEmail->setEmail($email);
        $newsletterEmail->setCategory($type);

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

    public function newsletterEmailUndoAction($email)
    {
        $allMails = $this ->getDoctrine()
                                ->getManager()
                                ->getRepository('LBFMainBundle:NewsletterEmail')
                                ->findAll();

        $newsletterEmail = new NewsletterEmail;
        for ($i=0; $i < sizeof($allMails); $i++) { 
            if ($allMails[$i]->getEmail() == $email) {
                $newsletterEmail = $allMails[$i];
                break;
            }
        }

        if ($newsletterEmail->getEmail()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($newsletterEmail);
            $em->flush();
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
                            ->findBy(['active' => array('active', 'new', 'toCome', 'soldOut')]);

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
                            ->findBy(['active' => array('active', 'new', 'toCome', 'soldOut')]);

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
            $em->flush();

            // Message for client
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('[Le Buffet Francés]')
                ->setFrom(array('antoine@lebuffetfrances.com' => 'Le Buffet Francés'))
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
                ->setFrom(array('antoine@lebuffetfrances.com' => 'Le Buffet Francés'))
                ->setTo('antoine@lebuffetfrances.com')
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

    public function confirmAction() 
    {    
        return $this->render('LBFMainBundle:Main:confirm.html.twig');
    }

    public function footerContactAction() 
    {

        /* Current User */
        $currentUser = $this->getUser();
        if ($currentUser) {
            $senderName = $currentUser->getFirstName();
            $senderEmail = $currentUser->getEmail();
        } else {
            $senderName = $_POST['senderContact'];
            $senderEmail = $_POST['emailContact'];
        }
        $senderSubject = $_POST['sujetMail'];
        
        $senderOrderNumber = '';
        if ($_POST['orderNumber']) {
            $senderOrderNumber = $_POST['orderNumber'];
        }

        $senderContent = $_POST['corpsMail'];

        // Message for client
        $message = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setSubject('[Le Buffet Francés]')
            ->setFrom(array('antoine@lebuffetfrances.com' => 'Le Buffet Francés'))
            ->setTo($senderEmail)
            ->setBody(
                $this->renderView('LBFMainBundle:Main:emailContactClient.html.twig',
                    array(  'senderName' => $senderName,
                            'senderSubject' => $senderSubject,
                            'senderOrderNumber' => $senderOrderNumber,
                            'senderContent' => $senderContent
                            )
                )
            )
        ;

        // Message for manager/admin
        $messageAdmin = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setSubject('[Le Buffet Francés] Nouveau message.')
            ->setFrom(array('antoine@lebuffetfrances.com' => 'Le Buffet Francés'))
            ->setTo('antoine@lebuffetfrances.com')
            ->setBody(
                $this->renderView('LBFMainBundle:Main:emailContactAdmin.html.twig',
                    array(  'senderName' => $senderName,
                            'senderEmail' => $senderEmail,
                            'senderSubject' => $senderSubject,
                            'senderOrderNumber' => $senderOrderNumber,
                            'senderContent' => $senderContent
                            )
                )
            )
        ;

        $this->get('mailer')->send($message);
        $this->get('mailer')->send($messageAdmin);        

        // On redirige vers la page de visualisation de le document nouvellement créé
        return $this->redirect($this->generateUrl('lbf_main_footer_contact_thankYou'));
    }

    public function footerContactThankYouAction() 
    {
        
        return $this->render('LBFMainBundle:Main:contactThankYou.html.twig');
    }

    public function newTestimonyAction()
    {
        $testimony = new Testimony;

        // On utiliser le OrdersType
        $formNewTestimony = $this->createForm(new TestimonyType(), $testimony);

        // On récupère la requête
        $formNewTestimony->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formNewTestimony->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($testimony);
            $em->flush();
            
            $messageAdminContent = stripslashes($formNewTestimony->get('content')->getData());
            $messageAdminAuthor = stripslashes($formNewTestimony->get('author')->getData());
            $messageAdminRate = stripslashes($formNewTestimony->get('rate')->getData());

            // Message for manager/admin
            $messageAdmin = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('[Le Buffet Francés] Nouveau commentaire.')
                ->setFrom(array('antoine@lebuffetfrances.com' => 'Le Buffet Francés'))
                ->setTo('antoine@lebuffetfrances.com')
                ->setBody(
                    $this->renderView('LBFAdminBundle:Admin:emailTestimonyAdmin.html.twig',
                        array(  
                            'messageAdminContent' => $messageAdminContent,
                            'messageAdminAuthor' => $messageAdminAuthor,
                            'messageAdminRate' => $messageAdminRate
                            )
                    )
                )
            ;

            $this->get('mailer')->send($messageAdmin);

            return $this->redirect($this->generateUrl('lbf_main_testimony_thankYou'));
            

        }
        return $this->render('LBFMainBundle:Main:newTestimony.html.twig', array(
            'formNewTestimony' => $formNewTestimony->createView()
            ));
    }

    public function thankYouTestimonyAction() 
    {
        
        return $this->render('LBFMainBundle:Main:thankYouTestimony.html.twig');
    }

}
