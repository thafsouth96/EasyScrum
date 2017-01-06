<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use EasyScrum\EasyScrumBundle\Form\AddFriendType ;

class UserController extends BaseController
{

  public function addFriendAction(Request $request){


    if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
    {
     $current_user = $this->container->get('security.token_storage')->getToken()->getUser();
    }
    

    $form =$this->createForm(AddFriendType::class);

    return $this->render('EasyScrumEasyScrumBundle:Team:addFriend.html.twig', array('form' =>$form->createView()));

    }


}
