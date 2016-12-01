<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EasyScrum\EasyScrumBundle\Entity\Projet ;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
      ->add('nom', TextType::class, array(
            'label' => 'Nom',
            'required' => true
      ))
      ->add('description', TextType::class, array(
            'label' => 'Description',
            'required' => false

      ))
      ->add('dateDebut' , DateType::class, array(
            'label' => 'Date Début',
            'required' => false
      ))
      ->add('dateFin', DateType::class, array(
            'label' =>'Date Fin',
            'required' => false
      ))
      /*->add('productOwner', ChoiceType::class, array(
            'choices' => array(
              '1'=>'user1',
              '2'=>"user2"
            ),
            'placeholder'=>'Sélectionner un productOwner',
            'label' => 'Product owner',
            'required' => false
      ))*/

      /*->add('budget', TextType::class, array(
            'label' => 'Budget',
            'required' => false
      ))*/
      ->add('create' , SubmitType::class, array(
            'label' => 'Créer'
      ));

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

    return $this->render('EasyScrumEasyScrumBundle:Projet:projetCreateVue.html.twig', array('form' =>$form->createView(),));


  }

    public function showProjectsAction(Request $request){

      $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');

        $listProjets = $repository->findAll(); // retourne toute les entités contenant das la base de données ==> la valeur de retour est un simple array
      /*  if (!$listprojets) {
            throw $this->createNotFoundException('Activité non trouvée.');
        }*/

        return $this->render('EasyScrumEasyScrumBundle:Projet:projetsListVue.html.twig', array('listProjets' => $listProjets));
    }

    public function projetViewAction($id){
      $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');

        $projet = $repository->find($id) ;
          if (!$projet) {
              throw $this->createNotFoundException('projet non trouvé.');
            }

        return $this->render('EasyScrumEasyScrumBundle:Projet:projetVue.html.twig', array('projet' => $projet));
    }

}
