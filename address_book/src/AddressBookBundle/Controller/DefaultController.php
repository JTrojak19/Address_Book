<?php

namespace AddressBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * 
     */
    public function addNewFormAction(Request $request)
    {
        $contact = new Contact();
        
        $form = $this->createFormBuilder($contact)
            ->add('name')
            ->add('surname')
            ->add('description')
            ->getForm();
         $form->handleRequest($request);
         
         if ($form->isSubmitted() && $form->isValid())
         {
             $contact = $form->getData();
             $em = $this->getDoctrine()->getManager();
             $em->persist($contact);
             $em->flush();
             return new Response('New Contact Created'); 
         }
         return $this->render('new.html.twig', array(
            'form' => $form->createView(), 
             ));
    }
}
