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
  //id = project id
  public function createAction(Request $request,$id){

  $release = new Release1();
  if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
  {
     $user = $this->container->get('security.token_storage')->getToken()->getUser();
     $username = $user->getUsername();
   }
     $em = $this->getDoctrine()->getManager();
     $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');

     $projet = $repository->findProjectById($id) ;
     var_dump($projet);
     var_dump($id);

     $form= $this->createForm(CreateRelease::class, $release, array(
        'current_user' => $user,
     ));

     $form->handleRequest($request);
     if($form->isValid() && $form->isSubmitted()){

       $nom = $form->get('nom')->getData();

       //on enregistre l'objet release dans la base de données
       $em = $this->getDoctrine()->getManager();

      // $release->setProjet($projet);
    //   $projet->addRelease($release);

       $em->persist($release);
       $em->flush();
     return new Response('Release'.$nom. 'Created ! ');
   }
   return $this->render('EasyScrumEasyScrumBundle:Release:releaseCreateView.html.twig', array('form' =>$form->createView(), 'id'=>$id));
  }




}
