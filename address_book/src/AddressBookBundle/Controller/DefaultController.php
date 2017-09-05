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
        $contacts = $this->getDoctrine()
                ->getRepository('AddressBookBundle:Contact')
                ->findAll(); 
        return new Response(var_dump($contacts)); 
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
             return new Response("Kontakt został utworzony");
         }
         return $this->render('new.html.twig', array(
            'form' => $form->createView(), 
             ));
    }
    /**
     * 
     * @Route("/{id}/modify")
     */
    public function modifyAction(Request $request, $id)
    {
        $contact = new Contact(); 
        $contact = $this->getDoctrine()
                ->getRepository('AddressBookBundle:Contact')
                ->find($id); 
        
        if (!$contact)
        {
            throw $this->createNotFoundException('Contact not found'); 
        }
        
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
             $em->flush();
             return new Response("Kontakt został zmodyfikowany"); 
              
         }
         return $this->render('modify.html.twig', array(
            'form' => $form->createView(), 
             ));
    }
    /**
     * 
     * @Route("{id}/delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $contact = new Contact(); 
        $contact = $this->getDoctrine()
                ->getRepository('AddressBookBundle:Contact')
                ->find($id); 
        
        if (!$contact)
        {
            throw $this->createNotFoundException('Contact not found'); 
        }
        
   
            $em = $this
            ->getDoctrine()
            ->getManager();

            $em->remove($contact);
            $em->flush(); 
            return new Response ("Kontakt został usunięty"); 
    }
    /**
     * 
     * @Route("/{id}")
     */
    public function showOneAction($id)
    {
        $contact = $this->getDoctrine()
                ->getRepository('AddressBookBundle:Contact')
                ->find($id); 
        
        if (!$contact)
        {
            throw $this->createNotFoundException('Contact now found'); 
        }
        return new Response(var_dump($contact)); 
    }
   
}
