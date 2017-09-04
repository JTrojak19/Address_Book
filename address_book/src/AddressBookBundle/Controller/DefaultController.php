<?php

namespace AddressBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use AddressBookBundle\Entity\Contact; 

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * 
     */
    public function indexAction()
    {
        return $this->render('index.html.twig');
    }
    /**
     * @Route("/new")
     */
    public function addNewAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('name')
            ->add('surname')
            ->add('description')
            ->getForm();
         return $this->render('new.html.twig', array(
            'form' => $form->createView(), 
             ));
    }
}
