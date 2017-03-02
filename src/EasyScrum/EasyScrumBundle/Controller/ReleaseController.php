<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EasyScrum\EasyScrumBundle\Entity\Release1;
use EasyScrum\EasyScrumBundle\Form\CreateRelease ;
use EasyScrum\EasyScrumBundle\Form\EditReleaseType ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReleaseController extends Controller
{
  //id = project id
  public function createAction(Request $request){

  $release = new Release1();

  if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
  {
     $user = $this->container->get('security.token_storage')->getToken()->getUser();
     $username = $user->getUsername();
   }
     $em = $this->getDoctrine()->getManager();
     $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');
     $form= $this->createForm(CreateRelease::class, $release, array(
        'current_user' => $user,
     ));

     $form->handleRequest($request);
     if($form->isValid() && $form->isSubmitted()){
       $nom = $form->get('nom')->getData();
       $project_id = $_POST['project_id'] ;
       $projet = $repository->findProjectById($project_id) ;
       $repositoryRelease = $em->getRepository('EasyScrumEasyScrumBundle:Release1');

       $releaseExistante  = $repositoryRelease->findReleaseByProject_name($projet,$nom);
       //var_dump($releaseExistante);

       if($releaseExistante !=null){
         $this->addFlash(
            'error',
            'Une release du meme nom existe déja!'
          );
          return $this->redirectToRoute('easy_scrum_dashbord');
       }
       else {
         $release->setProjet($projet[0]);
         $release->setActive(true);
         $projet[0]->addRelease($release);

         $em->persist($release);
         $em->flush();
         $this->addFlash(
            'success',
            'La release est bien créée!'
        );
        return $this->redirectToRoute('easy_scrum_dashbord');
       }
   }
   return $this->render('EasyScrumEasyScrumBundle:Release:releaseCreateView.html.twig', array('form' =>$form->createView()));
  }

  public function editAction(Request $request){
    $em = $this->getDoctrine()->getManager();
    $form = $this->createForm(EditReleaseType::class);
    //On fait le lien Requête <-> formulaire
    $form->handleRequest($request);

    //On vérifie que les valeurs entrées sont correctes
    if($form->isValid() && $form->isSubmitted())
    {

      $release_id = $_POST['releaseToEdit_id'];
      $repository = $em->getRepository('EasyScrumEasyScrumBundle:Release1');
      $release = $repository->findOneBy(array('id'=> $release_id));
      $nom = $form->get('nom')->getData();
      $description = $form->get('description')->getData();
      $project = $release->getProjet();

      $existingRelease = $repository->findReleaseByProject_name($project, $nom);
      if($existingRelease){
        $this->addFlash(
           'success',
           'Une release avec le même nom existe déja '
       );
         return $this->redirectToRoute('easy_scrum_dashbord');
      } else {

      $release->setNom($nom);
      $release->setDescription($description);
      $em->merge($release);
      $em->flush();
      $this->addFlash(
         'success',
         'La release est mise à jour!'
     );
       return $this->redirectToRoute('easy_scrum_dashbord');
     }
    }
     return $this->render('EasyScrumEasyScrumBundle:Release:releaseEditView.html.twig', array('form' =>$form->createView()));

  }
  public function deleteAction(Request $request) {
    $release_id =$_POST['releaseToDelete_id'];
    $em = $this->getDoctrine()->getManager();

    $repository = $em->getRepository('EasyScrumEasyScrumBundle:Release1');
    $release = $repository->findOneBy(array('id' => $release_id));
    var_dump($release);

    $em->remove($release);
    $em->flush();
    $this->addFlash(
       'success',
       'La release est bien supprimée !'
   );
     return $this->redirectToRoute('easy_scrum_dashbord');
  }

}
