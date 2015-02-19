<?php

namespace LBF\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

        return $this->render('LBFAdminBundle:Admin:indexAdmin.html.twig', array(
            'users' => $users,
            'newsletterEmails' => $newsletterEmails,
            'currentOrders' => $currentOrders,
            'pastOrders' => $pastOrders));
    }

    public function answerAction($orderId)
    {

        $allElements = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFMainBundle:Element')
                            ->findAll();

        $order = $this ->getDoctrine()
                                ->getManager()
                                ->getRepository('LBFUserBundle:Orders')
                                ->find($orderId);

        return $this->render('LBFAdminBundle:Admin:answer.html.twig', array(
            'allElements' => $allElements,
            'order' => $order
            ));
    }


    public function confirmAction($orderId, $status)
    {
        $confirmedOrder = $this ->getDoctrine()
                                ->getManager()
                                ->getRepository('LBFUserBundle:Orders')
                                ->find($orderId);

        // Gérer la liste
        $newElements = array();
        $currentElements = $confirmedOrder->getElements();
        for ($i=0; $i < sizeof($currentElements); $i++) { 
            $element = $currentElements[$i]['item'];
            $string = "'".$element->getType()."'";
            if ($_POST[$string] == 'YES') {
                $newElements[] = $element;
            }
        }
        $confirmedOrder->setElements($newElements);

        // Gérer la date de livraison
        $date = $post['deliveryAt_date_year'].'-'.$post['deliveryAt_date_month'].'-'.$post['deliveryAt_date_day'].' '.$post['deliveryAt_time_hour'].':'.$post['deliveryAt_time_minute'].':00';
        $newDate = \Datetime::createFromFormat('yyyy-mm-dd hh:mm:ss', $date);
        $confirmedOrder->setDeliveryAt($newDate);

        // Gérer le statut
        $confirmedOrder->setStatus($status);
        $em = $this->getDoctrine()->getManager();
        $em->persist($confirmedOrder);
        $em->flush();

        // Message for client
        $message = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setSubject('[Le Buffet Francés] Your order is now confirmed.')
            ->setFrom(array('contact@lebuffetfrances.com' => 'Le Buffet Francés'))
            ->setTo($confirmedOrder->getUser()->getEmail())
            ->setBody(
                $this->renderView('LBFUserBundle:User:emailAdmin.html.twig',
                    array(  'confirmedOrder' => $confirmedOrder)
                )
            )
        ;

        $this->get('mailer')->send($message);

        // On redirige vers la page de visualisation de le document nouvellement créé
        return $this->redirect($this->generateUrl('lbf_admin_homepage'));
    }
}
