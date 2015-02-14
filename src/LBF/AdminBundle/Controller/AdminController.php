<?php

namespace LBF\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('LBFAdminBundle:Admin:indexAdmin.html.twig');
    }
}
