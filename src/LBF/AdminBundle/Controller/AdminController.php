<?php

namespace LBF\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LBF\MainBundle\Entity\Element;
use LBF\MainBundle\Entity\Recipe;

use LBF\UserBundle\Form\AdminConfirmOrdersType;
use LBF\MainBundle\Form\ElementType;
use LBF\MainBundle\Form\RecipeType;

use LBF\MainBundle\Entity\Testimony;
use LBF\MainBundle\Form\TestimonySmallType;

use LBF\MainBundle\Form\NewsletterEmailType;

use LBF\UserBundle\Form\EditUserType;
use LBF\UserBundle\Form\EditCompanyType;

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

    public function currentOrdersAction($sortBy = null, $order = null)
    {
        if ($sortBy) {
            $currentOrders = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:Orders')
                            ->findBy(['status' => array('confirm', 'onHold', 'refused')], [$sortBy => $order]);
        }
        else {
            $currentOrders = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:Orders')
                            ->findBy(['status' => array('confirm', 'onHold', 'refused')], ['createdAt' => 'DESC']);
        }
        
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

    public function deleteOrderCompleteAction($orderId)
    {
        $order = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('LBFUserBundle:Orders')
                        ->find($orderId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($order);
        $em->flush();

        return $this->redirect($this->generateUrl('lbf_admin_pastOrders'));
    }

    public function pastOrdersAction($sortBy = null, $order = null)
    {
        if ($sortBy) {
            $pastOrders = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:Orders')
                            ->findBy(['status' => 'complete'], [$sortBy => $order]);
        }
        else {
            $pastOrders = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:Orders')
                            ->findBy(['status' => 'complete'], ['createdAt' => 'DESC']);
        }
        
        return $this->render('LBFAdminBundle:Admin:pastOrders.html.twig', array(
            'pastOrders' => $pastOrders
            ));
    }

    public function usersAction($sortBy = null, $order = null)
    {
        if ($sortBy) {
            $users = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:User')
                            ->findBy(['type' => 1], [$sortBy => $order]);
        }
        else {
            $users = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:User')
                            ->findBy(['type' => 1], ['lastLogin' => 'DESC']);
        }
        

        return $this->render('LBFAdminBundle:Admin:users.html.twig', array(
            'users' => $users
            ));
    }

    public function newUserAction($userId = null)
    {
        if (sizeof($userId) > 0) {
            $user = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:User')
                            ->find($userId);
        } else {
            $user = new User;
        }
        
        // On utiliser le EditAvatarType
        $formAdminUser = $this->createForm(new EditUserType(), $user);

        // On récupère la requête
        $formAdminUser->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formAdminUser->isValid()) {
            $user->setUpdatedAt(new \Datetime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('lbf_admin_users'));
        }

        return $this->render('LBFAdminBundle:Admin:newUser.html.twig', array(
            'formAdminUser' => $formAdminUser->createView()
            ));
    }

    public function deleteUserAction($userId)
    {
        $user = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('LBFUserBundle:User')
                        ->find($userId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirect($this->generateUrl('lbf_admin_users'));
    }

    public function usersEmailsAction()
    {
        $users = $this ->getDoctrine()
                                    ->getManager()
                                    ->getRepository('LBFUserBundle:User')
                                    ->findBy(['type' => 1]);

        return $this->render('LBFAdminBundle:Admin:usersEmails.html.twig', array(
            'users' => $users
            ));
    }

    public function companiesAction($sortBy = null, $order = null)
    {
        if ($sortBy) {
            $companies = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:User')
                            ->findBy(['type' => 0], [$sortBy => $order]);
        }
        else {
            $companies = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:User')
                            ->findBy(['type' => 0], ['lastLogin' => 'DESC']);
        }
        

        return $this->render('LBFAdminBundle:Admin:companies.html.twig', array(
            'companies' => $companies
            ));
    }

    public function newCompanyAction($companyId = null)
    {
        if (sizeof($companyId) > 0) {
            $company = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:User')
                            ->find($companyId);
        } else {
            $company = new User;
        }
        
        // On utiliser le EditAvatarType
        $formAdminCompany = $this->createForm(new EditCompanyType(), $company);

        // On récupère la requête
        $formAdminCompany->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formAdminCompany->isValid()) {
            $company->setUpdatedAt(new \Datetime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('lbf_admin_companies'));
        }

        return $this->render('LBFAdminBundle:Admin:newCompany.html.twig', array(
            'formAdminCompany' => $formAdminCompany->createView()
            ));
    }

    public function deleteCompanyAction($companyId)
    {
        $company = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('LBFUserBundle:User')
                        ->find($companyId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($company);
        $em->flush();

        return $this->redirect($this->generateUrl('lbf_admin_companies'));
    }

    public function companiesEmailsAction()
    {
        $companies = $this ->getDoctrine()
                                    ->getManager()
                                    ->getRepository('LBFUserBundle:User')
                                    ->findBy(['type' => 0]);

        return $this->render('LBFAdminBundle:Admin:companiesEmails.html.twig', array(
            'companies' => $companies
            ));
    }

    public function newsletterAction($sortBy = null, $order = null)
    {
        if ($sortBy) {
            $newsletterEmails = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:NewsletterEmail')
                            ->findBy([], [$sortBy => $order]);
        }
        else {
            $newsletterEmails = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:NewsletterEmail')
                            ->findBy([], ['createdAt' => 'DESC']);
        }
        

        return $this->render('LBFAdminBundle:Admin:newsletter.html.twig', array(
            'newsletterEmails' => $newsletterEmails
            ));
    }
    
    public function newsletterEmailsAction($emailType = null)
    {
        if ($emailType == null) {
            $newsletterEmails = $this ->getDoctrine()
                                        ->getManager()
                                        ->getRepository('LBFMainBundle:NewsletterEmail')
                                        ->findAll();
        }
        else {
            $newsletterEmails = $this ->getDoctrine()
                                        ->getManager()
                                        ->getRepository('LBFMainBundle:NewsletterEmail')
                                        ->findByCategory($emailType);
        }


        return $this->render('LBFAdminBundle:Admin:newsletterEmails.html.twig', array(
            'newsletterEmails' => $newsletterEmails
            ));
    }

    public function editEmailAction($emailId)
    {
        $email = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('LBFMainBundle:NewsletterEmail')
                        ->find($emailId);
        
        // On utiliser le EditAvatarType
        $formEmail = $this->createForm(new NewsletterEmailType(), $email);

        // On récupère la requête
        $formEmail->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formEmail->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('lbf_admin_newsletter'));
        }

        return $this->render('LBFAdminBundle:Admin:editNewsletterEmail.html.twig', array(
            'formEmail' => $formEmail->createView()
            ));
    }

    public function commentsAction($sortBy = null, $order = null)
    {
        if ($sortBy) {
            $comments = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Testimony')
                            ->findBy([], [$sortBy => $order]);
        }
        else {
            $comments = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Testimony')
                            ->findBy([], ['createdAt' => 'DESC']);
        }
        

        return $this->render('LBFAdminBundle:Admin:comments.html.twig', array(
            'comments' => $comments
            ));
    }

    public function newCommentAction($commentId = null)
    {
        if (sizeof($commentId) > 0) {
            $comment = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Testimony')
                            ->find($commentId);
        } else {
            $comment = new Testimony;
        }
        
        // On utiliser le EditAvatarType
        $formTestimony = $this->createForm(new TestimonySmallType(), $comment);

        // On récupère la requête
        $formTestimony->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formTestimony->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('lbf_admin_comments'));
        }

        return $this->render('LBFAdminBundle:Admin:newTestimony.html.twig', array(
            'formTestimony' => $formTestimony->createView()
            ));
    }

    public function deleteCommentAction($commentId)
    {
        $comment = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('LBFMainBundle:Testimony')
                        ->find($commentId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('lbf_admin_comments'));
    }

    public function elementsAction($sortBy = null, $order = null)
    {
        if ($sortBy) {
            $elements = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findBy([], [$sortBy => $order]);
        }
        else {
            $elements = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findBy([], ['nameEs' => 'ASC']);
        }
        

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

    public function recipesAction($sortBy = null, $order = null)
    {
        if ($sortBy) {
            $recipes = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Recipe')
                            ->findBy([], [$sortBy => $order]);
        }
        else {
            $recipes = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Recipe')
                            ->findBy([], ['title' => 'ASC']);
        }
        

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
