<?php

namespace LBF\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LBF\MainBundle\Entity\Element;
use LBF\MainBundle\Entity\Recipe;

use LBF\UserBundle\Form\AdminConfirmOrdersType;
use LBF\MainBundle\Form\ElementType;
use LBF\MainBundle\Form\RecipeType;

class AdminController extends Controller
{
    public function indexAction()
    {
    	$users = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:User')
                            ->findAll();

        $newsletterEmails = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:NewsletterEmail')
                            ->findAll();

    	$currentOrders = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:Orders')
                            ->findSpecificAdminNon('complete', 10);

        $pastOrders = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:Orders')
                            ->findSpecificAdmin('complete', 10);

        $elements = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findAll();

        $recipes = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Recipe')
                            ->findAll();

        return $this->render('LBFAdminBundle:Admin:indexAdmin.html.twig', array(
            'users' => $users,
            'newsletterEmails' => $newsletterEmails,
            'currentOrders' => $currentOrders,
            'pastOrders' => $pastOrders,
            'elements' => $elements,
            'recipes' => $recipes
            ));
    }

    public function currentOrdersAction()
    {
        $currentOrders = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:Orders')
                            ->findSpecificAdminNon('complete', 10);

        return $this->render('LBFAdminBundle:Admin:currentOrders.html.twig', array(
            'currentOrders' => $currentOrders
            ));
    }

    public function answerOrderAction($orderId)
    {
        $allElements = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findAll();

        $order = $this ->getDoctrine()
                                ->getManager()
                                ->getRepository('LBFUserBundle:Orders')
                                ->find($orderId);

        // On utiliser le OrdersType
        $formConfirmOrder = $this->createForm(new AdminConfirmOrdersType(), $order);

        // On récupère la requête
        $formConfirmOrder->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formConfirmOrder->isValid()) {

            // Gérer la liste
            $newElements = array();
            $currentElements = $order->getElements();
            for ($i=0; $i < sizeof($currentElements); $i++) { 
                $element = $currentElements[$i]['item'];
                $qty = $currentElements[$i]['qty'];
                $string = $element->getType();
                if (isset($_POST[$string]) and $_POST[$string] == 'YES') {
                    $newElements[] = ['item'=> $element, 'qty' => $qty];
                }
            }
            
            $order->setElements($newElements);

            $status = $order->getStatus();

            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
            
            $messageAdminContent = stripslashes($formConfirmOrder->get('message')->getData());

            // Message for client
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('[Le Buffet Francés]')
                ->setFrom(array('antoine@lebuffetfrances.com' => 'Le Buffet Francés'))
                ->setTo($order->getUser()->getEmail())
                ->setBody(
                    $this->renderView('LBFAdminBundle:Admin:emailConfirmClient.html.twig',
                        array(  'order' => $order,
                                'status' => $status,
                                'messageAdminContent' => $messageAdminContent
                            )
                    )
                )
            ;

            $this->get('mailer')->send($message);

            // Message for manager/admin
            $messageAdmin = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('[Le Buffet Francés] Commande confirmée.')
                ->setFrom(array('antoine@lebuffetfrances.com' => 'Le Buffet Francés'))
                ->setTo('antoine@lebuffetfrances.com')
                ->setBody(
                    $this->renderView('LBFAdminBundle:Admin:emailConfirmAdmin.html.twig',
                        array(  'order' => $order,
                                'status' => $status,
                                'messageAdminContent' => $messageAdminContent
                                )
                    )
                )
            ;

            $this->get('mailer')->send($messageAdmin);

            return $this->redirect($this->generateUrl('lbf_admin_homepage'));
            

        }
        return $this->render('LBFAdminBundle:Admin:answer.html.twig', array(
            'allElements' => $allElements,
            'order' => $order,
            'formConfirmOrder' => $formConfirmOrder->createView()
            ));
    }

    public function completeOrderAction($orderId)
    {
        $order = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('LBFUserBundle:Orders')
                        ->find($orderId);

        $order->setStatus('complete');
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        // Message for client
        $message = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setSubject('[Le Buffet Francés]')
            ->setFrom(array('antoine@lebuffetfrances.com' => 'Le Buffet Francés'))
            ->setTo($order->getUser()->getEmail())
            ->setBody(
                $this->renderView('LBFAdminBundle:Admin:emailCompleteClient.html.twig',
                    array(  'order' => $order
                            )
                )
            )
        ;

        $this->get('mailer')->send($message);

        // Message for manager/admin
        $messageAdmin = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setSubject('[Le Buffet Francés] Commande terminée.')
            ->setFrom(array('antoine@lebuffetfrances.com' => 'Le Buffet Francés'))
            ->setTo('antoine@lebuffetfrances.com')
            ->setBody(
                $this->renderView('LBFAdminBundle:Admin:emailCompleteAdmin.html.twig',
                    array(  'order' => $order
                            )
                )
            )
        ;

        $this->get('mailer')->send($messageAdmin);

        return $this->redirect($this->generateUrl('lbf_admin_pastOrders'));
    }

    public function deleteOrderAction($orderId)
    {
        $order = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('LBFUserBundle:Orders')
                        ->find($orderId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($order);
        $em->flush();

        return $this->redirect($this->generateUrl('lbf_admin_currentOrders'));
    }

    public function pastOrdersAction()
    {
        $pastOrders = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:Orders')
                            ->findSpecificAdmin('complete', 10);

        return $this->render('LBFAdminBundle:Admin:pastOrders.html.twig', array(
            'pastOrders' => $pastOrders
            ));
    }

    public function usersAction()
    {
        $users = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:User')
                            ->findAll();

        return $this->render('LBFAdminBundle:Admin:users.html.twig', array(
            'users' => $users
            ));
    }

    public function newsletterAction()
    {
        $newsletterEmails = $this ->getDoctrine()
                                    ->getManager()
                                    ->getRepository('LBFMainBundle:NewsletterEmail')
                                    ->findAll();


        return $this->render('LBFAdminBundle:Admin:newsletter.html.twig', array(
            'newsletterEmails' => $newsletterEmails
            ));
    }
    
    public function newsletterEmailsAction()
    {
        $newsletterEmails = $this ->getDoctrine()
                                    ->getManager()
                                    ->getRepository('LBFMainBundle:NewsletterEmail')
                                    ->findAll();


        return $this->render('LBFAdminBundle:Admin:newsletterEmails.html.twig', array(
            'newsletterEmails' => $newsletterEmails
            ));
    }

    public function elementsAction()
    {
        $elements = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findAll();

        return $this->render('LBFAdminBundle:Admin:elements.html.twig', array(
            'elements' => $elements
            ));
    }

    public function newElementAction($elementId = null)
    {
        if (sizeof($elementId) > 0) {
            $element = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->find($elementId);
        } else {
            $element = new Element;
        }
        
        // On utiliser le EditAvatarType
        $formElement = $this->createForm(new ElementType(), $element);

        // On récupère la requête
        $formElement->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formElement->isValid()) {
            $element->setUpdatedAt(new \Datetime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('lbf_admin_elements'));
        }

        return $this->render('LBFAdminBundle:Admin:newElement.html.twig', array(
            'formElement' => $formElement->createView()
            ));
    }

    public function deleteElementAction($elementId)
    {
        $element = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('LBFMainBundle:Element')
                        ->find($elementId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($element);
        $em->flush();

        return $this->redirect($this->generateUrl('lbf_admin_elements'));
    }

    public function recipesAction()
    {
        $recipes = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Recipe')
                            ->findAll();

        return $this->render('LBFAdminBundle:Admin:recipes.html.twig', array(
            'recipes' => $recipes
            ));
    }

    public function newRecipeAction($recipeId = null)
    {
        if (sizeof($recipeId) > 0) {
            $recipe = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Recipe')
                            ->find($recipeId);
        } else {
            $recipe = new Recipe;
        }
        
        // On utiliser le EditAvatarType
        $formRecipe = $this->createForm(new RecipeType(), $recipe);

        // On récupère la requête
        $formRecipe->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formRecipe->isValid()) {
            $recipe->setUpdatedAt(new \Datetime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('lbf_admin_recipes'));
        }

        return $this->render('LBFAdminBundle:Admin:newRecipe.html.twig', array(
            'formRecipe' => $formRecipe->createView()
            ));
    }

    public function deleteRecipeAction($recipeId)
    {
        $recipe = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('LBFMainBundle:Recipe')
                        ->find($recipeId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($recipe);
        $em->flush();

        return $this->redirect($this->generateUrl('lbf_admin_recipes'));
    }

    
}
