<?php

namespace LBF\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LBF\UserBundle\Entity\User;

use LBF\UserBundle\Form\EditUserType;
use LBF\UserBundle\Form\EditCompanyType;
use LBF\UserBundle\Form\EditAvatarType;

class UserController extends Controller
{
    public function indexAction()
    {
    	/* Current User */
        $currentUser = $this->getUser();

        // On utiliser le EditAvatarType
        $formEditAvatar = $this->createForm(new EditAvatarType(), $currentUser);

        // On récupère la requête
        $formEditAvatar->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formEditAvatar->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($currentUser);
            $em->flush();

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('lbf_user_homepage'));
        }

        // On utiliser le EditUserType
        $formEditUser = $this->createForm(new EditUserType(), $currentUser);

        // On récupère la requête
        $formEditUser->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formEditUser->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($currentUser);
            $em->flush();

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('lbf_user_homepage'));
        }

        // On utiliser le EditCompanyType
        $formEditCompany = $this->createForm(new EditCompanyType(), $currentUser);

        // On récupère la requête
        $formEditCompany->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formEditCompany->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($currentUser);
            $em->flush();

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('lbf_user_homepage'));
        }

        $currentOrders = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:Orders')
                            ->findSpecificNon($currentUser, 'complete', 10);

        $pastOrders = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('LBFUserBundle:Orders')
                            ->findSpecific($currentUser, 'complete', 10);

        return $this->render('LBFUserBundle:User:indexUser.html.twig', array(
            'currentOrders' => $currentOrders,
            'pastOrders' => $pastOrders,
            'formEditUser' => $formEditUser->createView(),
            'formEditCompany' => $formEditCompany->createView(),
            'formEditAvatar' => $formEditAvatar->createView()));
    }

}
