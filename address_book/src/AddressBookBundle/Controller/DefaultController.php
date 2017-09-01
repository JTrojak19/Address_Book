<?php

namespace AddressBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use AddressBookBundle\Entity\Contact; 

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AddressBookBundle:Default:index.html.twig');
    }
    /**
     * @Route("/new")
     * 
     */
    public function addNewEntityAction(Request $request)
    {
        $request->request->get('new'); 
        $contact = new Contact(); 
        $form = $this->createFormBuilder($contact)
                ->add('name', 'text')
                ->add('surname', 'text')
                ->add('description', 'text')
                ->getForm();       
        return $this->render('AddressBookBundle:Default:new.html.twig', array('form'=>$form->createView())); 
    }
}
