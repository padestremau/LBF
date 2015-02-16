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
}
