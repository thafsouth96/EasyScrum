<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EasyScrum\EasyScrumBundle\Entity\Task;
use EasyScrum\EasyScrumBundle\Form\CreateTaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function createAction(Request $request)
    {
      $task = new Task();

      if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
      {
       $current_user = $this->container->get('security.token_storage')->getToken()->getUser();
      }

       $form = $this->createForm(CreateTaskType::class, $task);

       $form->handleRequest($request);

       if($form->isValid() && $form->isSubmitted())
       {

           $nom = $form->get('name')->getData();


           $em = $this->getDoctrine()->getManager();
           $repository = $em->getRepository('EasyScrumEasyScrumBundle:Task');

           /* TODO : vérifier que y a pas la meme tache du meme nom dans le user Story */
           /* PB : j'arrive pas à récupérer l'id de la userStory */
            $em->persist($task);
            $em->flush();
            $this->addFlash(
               'task',
               'Le tache est bien créée!'
           );

      }
       return $this->render('EasyScrumEasyScrumBundle:Task:create.html.twig', array('form' =>$form->createView()));
    }

}
