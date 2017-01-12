<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EasyScrum\EasyScrumBundle\Entity\Sprint;
use EasyScrum\EasyScrumBundle\Form\CreateSprintType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SprintController extends Controller
{
    public function createAction(Request $request)
    {
      $sprint = new Sprint();

      if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
      {
       $current_user = $this->container->get('security.token_storage')->getToken()->getUser();
      }

       $form = $this->createForm(CreateSprintType::class, $sprint);

       $form->handleRequest($request);

       if($form->isValid() && $form->isSubmitted())
       {

           $nom = $form->get('name')->getData();


           $em = $this->getDoctrine()->getManager();
           $repository = $em->getRepository('EasyScrumEasyScrumBundle:Sprint');

           /* TODO : vérifier que y a pas le meme sprint du meme nom dans la release */
           /* PB : j'arrive pas à récupérer l'id de la release */


            $em->persist($sprint);
            $em->flush();
            $this->addFlash(
               'success',
               'Le sprint est bien créer!'
           );

      }
       return $this->render('EasyScrumEasyScrumBundle:Sprint:create.html.twig', array('form' =>$form->createView()));
    }

}
