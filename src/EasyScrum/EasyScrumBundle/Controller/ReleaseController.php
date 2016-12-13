<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EasyScrum\EasyScrumBundle\Entity\Release1;
use EasyScrum\EasyScrumBundle\Form\CreateRelease ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReleaseController extends Controller
{
  public function createAction(Request $request){

  $release = new Release1();
  if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
  {
     $user = $this->container->get('security.token_storage')->getToken()->getUser();
     $username = $user->getUsername();
   }

     $form= $this->createForm(CreateRelease::class, $release, array(
        'current_user' => $user,
     ));

     $form->handleRequest($request);
     if($form->isValid() && $form->isSubmitted()){

       $nom = $form->get('nom')->getData();
       $release->setNom($nom);


       //on enregistre l'objet projet dans la base de données
       $em = $this->getDoctrine()->getManager();

       $em->persist($release);
       $em->flush();

       //Redirection vers la vue projet "createProject à modifier "
       //return $this->redirectToRoute('project_create');
     return new Response('Release'.$nom. 'Created ! ');
   }
   return $this->render('EasyScrumEasyScrumBundle:Release:releaseCreateView.html.twig', array('form' =>$form->createView()));
  }



}
