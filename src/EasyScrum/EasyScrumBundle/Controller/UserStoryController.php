<?php
namespace EasyScrum\EasyScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EasyScrum\EasyScrumBundle\Entity\UserStory;
use EasyScrum\EasyScrumBundle\Form\CreateUserStoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserStoryController extends Controller
{
    public function createAction(Request $request)
    {
      $userStory = new UserStory();

      if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
      {
       $current_user = $this->container->get('security.token_storage')->getToken()->getUser();
      }

       $form = $this->createForm(CreateUserStoryType::class, $userStory);

       $form->handleRequest($request);

       if($form->isValid() && $form->isSubmitted())
       {

           $nom = $form->get('name')->getData();


           $em = $this->getDoctrine()->getManager();
           $repository = $em->getRepository('EasyScrumEasyScrumBundle:UserStory');

           /* TODO : vérifier que y a pas le meme userStory du meme nom dans le sprint */
           /* PB : j'arrive pas à récupérer l'id de la sprint */
            $em->persist($userStory);
            $em->flush();
            $this->addFlash(
               'userStory',
               'Le userStory est bien créer!'
           );

      }
       return $this->render('EasyScrumEasyScrumBundle:UserStory:create.html.twig', array('form' =>$form->createView()));
    }

}
