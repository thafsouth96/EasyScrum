<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use EasyScrum\EasyScrumBundle\Form\AddFriendType ;

class UserController extends BaseController
{

  public function addFriendAction(Request $request, $users){


    if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
    {
     $current_user = $this->container->get('security.token_storage')->getToken()->getUser();
    }
    $form =$this->createForm(AddFriendType::class);

    if($form->isValid() && $form->isSubmitted())
    {
      $name = $form->get('name')->getData();
      $userManager = $this->get('fos_user.user_manager');
      $users = $userManager->findUserByUsername($name);

      $this->addFlash(
         'error',
         'je suis là ! '
       );
        return $this->render('EasyScrumEasyScrumBundle:Team:showFriend.html.twig',array('users' => $users));  

    }
    return $this->render('EasyScrumEasyScrumBundle:Team:addFriend.html.twig', array('form' =>$form->createView()));

    }


}
