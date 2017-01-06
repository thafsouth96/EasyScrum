<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EasyScrum\EasyScrumBundle\Entity\Team;
use EasyScrum\EasyScrumBundle\Form\CreateTeam ;

class TeamController extends Controller
{
  public function createAction(Request $request){

  $team = new Team();
  if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
  {
     $current_user = $this->container->get('security.token_storage')->getToken()->getUser();

   }

     $form= $this->createForm(CreateTeam::class, $team, array(
        'current_user' => $current_user,
     ));

     $form->handleRequest($request);

     if($form->isValid() && $form->isSubmitted()){

       $nom = $form->get('nom')->getData();
       $em = $this->getDoctrine()->getManager();
       $repository = $em->getRepository('EasyScrumEasyScrumBundle:Team');

       $teamExistante = $repository->findTeamByNom_admin($current_user,$nom) ;
       if($teamExistante !=null){
                 $this->addFlash(
                    'error',
                    'La team existe déja!'
                  );
                  return $this->redirectToRoute('easy_scrum_dashbord');
       }
       else {
       $current_user->addMyTeam($team);
       $team->setAdmin($current_user);
       //on enregistre l'objet projet dans la base de données
       $em->persist($team);
       $em->flush();
       $this->addFlash(
          'success',
          'La team est bien créer!');
   }
 }
   return $this->render('EasyScrumEasyScrumBundle:Team:teamCreateView.html.twig', array('form' =>$form->createView()));
  }

  public function showTeamsAction(Request $request){

    if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
    {
     $current_user = $this->container->get('security.token_storage')->getToken()->getUser();
    }
    $listMesTeams = $current_user->getMyTeams();
    $teams = $current_user->getTeams();
    $friends = $current_user->getFriends();

    return $this->render('EasyScrumEasyScrumBundle:Team:allTeamView.html.twig', array('listMesTeams' => $listMesTeams, 'teams' => $teams, 'friends' => $friends));
    }
}
