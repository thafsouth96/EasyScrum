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

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(CreateSprintType::class, $sprint);

       $form->handleRequest($request);

       if($form->isValid() && $form->isSubmitted())
       {
         $nom = $form->get('name')->getData();
         $release_id = $_POST['release_id'];
         $repository = $em->getRepository('EasyScrumEasyScrumBundle:Release1');
         $release = $repository->findOneBy(array('id' => $release_id));
         $repositorySprint = $em->getRepository('EasyScrumEasyScrumBundle:Sprint');
         $sprintExistant = $repositorySprint->findSprintByRlease_name($release,$nom);

         if($sprintExistant != null){
           $this->addFlash(
              'error',
              'Un sprint du meme nom existe déja!'
            );
            return $this->redirectToRoute('easy_scrum_dashbord');
         }

         else {
           $sprint->setRelease($release);
           $sprint->setProjet($release->getProjet());
           $release->addSprint($sprint);
           $em->persist($sprint);
           $em->flush();
           $this->addFlash(
              'success',
              'Le sprint est bien créer!'
          );
            return $this->redirectToRoute('easy_scrum_dashbord');
         }

      }
       return $this->render('EasyScrumEasyScrumBundle:Sprint:create.html.twig', array('form' =>$form->createView()));
    }

}
