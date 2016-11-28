<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EasyScrum\EasyScrumBundle\Entity\Projet ;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProjetController extends Controller

{
  public function indexAction()
  {
      return $this->render('EasyScrumEasyScrumBundle:Default:projetVue.html.twig');
  }
  public function createAction(Request $request)
  {
    //On crée l'objet projet
    $projet = new Projet();

    //Création du formulaire grace au service form factory
    $formBuilder= $this->createFormBuilder($projet);

    //On ajoute les champs de l'entité que l'n veut à notre formulaire
    $formBuilder
    ->add('nom', TextType::class)
    ->add('description', TextType::class)
    ->add('active' , CheckboxType::class)
    ->add('dateCreation' , DateType::class)
    ->add('créer' , SubmitType::class);

    // On génère le formulaire à partir du form builder
    $form = $formBuilder->getForm();

  //On fait le lien Requête <-> formulaire
  //A partir de maintenant la variable projet contient les valeurs entrée par l'utilisateur

  $form->handleRequest($request);

  //On vérifie que les valeurs entrées sont correctes
  if($form->isValid()){
    //on enregistre l'objet projet dans la base de données
    $em = $this->getDoctrine()->getManager();
    $em->persist($projet);
    $em->flush();
    $request->getSession()->getFlashBag->add('notice' , 'Projet est créer') ;

    //Redirection vers la vue projet
    
    //return $this->redirect($this->ur)

  }

  return $this->render('EasyScrumEasyScrumBundle:default:projetVue.html.twig', array('form' =>$form->createView(),));


}
}
