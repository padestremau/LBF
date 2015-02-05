<?php

namespace LBF\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('LBFUserBundle:User:indexUser.html.twig');
    }
}
