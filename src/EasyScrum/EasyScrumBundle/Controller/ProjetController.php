<?php

namespace EasyScrum\EasyScrumBundle\Controller;


use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use EasyScrum\EasyScrumBundle\Entity\Projet;
use EasyScrum\EasyScrumBundle\Form\CreateProject;
use EasyScrum\EasyScrumBundle\Form\EditProjectType;
use Doctrine\Common\Collections\ArrayCollection;

class ProjetController extends Controller

{

    public function indexAction()
    {
        return $this->render('EasyScrumEasyScrumBundle:Projet:projetVue.html.twig');
    }

public function createAction(Request $request){
  //On crée l'objet projet
  $projet = new Projet();
  //On récupère l'utilisateur connecté
  if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
  {
   $current_user = $this->container->get('security.token_storage')->getToken()->getUser();
  }
   // On génère le formulaire à partir de l'objet createProjet dans Form
   $form = $this->createForm(CreateProject::class, $projet);
   //On fait le lien Requête <-> formulaire
   $form->handleRequest($request);

   //On vérifie que les valeurs entrées sont correctes
   if($form->isValid() && $form->isSubmitted())
   {
       // Retourne le nom du projet saisie dans le formulaire
       $nom = $form->get('nom')->getData();

       //On cherche dans la base de données si y a pas un projet du meme nom
       $em = $this->getDoctrine()->getManager();
       $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');

       $projetExistant = $repository->findProjectByName_user($current_user,$nom) ;

       //Si le projet existe
       if($projetExistant != null )
       {
        // Et le productOwner du projet existant est le meme que l'utilisateur connecté

        $this->addFlash(
           'error',
           'Le projet existe déja!'
         );
         return $this->redirectToRoute('easy_scrum_dashbord');
        }

      // Si le projet n'existe pas ou que le productOwner n'est pas le meme
       else
        {
        $projet->setNom($nom);
        $projet->setProductOwner($current_user);
        $current_user->addMonProjet($projet);
        //On enregistre le projet dans la base de données
        $em->persist($projet);
        $em->flush();
        $this->addFlash(
           'success',
           'Le projet est bien créer!'
       );

        // Redirection vers la vue projet "createProject à modifier"

         return $this->redirectToRoute('easy_scrum_dashbord');
      }

  }
   return $this->render('EasyScrumEasyScrumBundle:Projet:projetCreateVue.html.twig', array('form' =>$form->createView()));
}

    public function showProjectsAction(Request $request){

      $current_user = $this->getUser();
      $myProjects = $current_user->getMesProjets() ;
      foreach ($myProjects as $project) {
        if(!$project->isActive()){
          $myProjects->removeElement($project) ;
        }
      }
      $projects = $current_user->getProjets();
      foreach ($projects as $project) {
        if(!$project->isActive()){
          $projects->removeElement($project) ;
        }
      }
      /*$allProjets = new ArrayCollection(
        array_merge($listMesProjets->toArray(), $listProjets->toArray())
      );*/

      return $this->render('EasyScrumEasyScrumBundle:Projet:allprojetsVue.html.twig', array('myProjects' => $myProjects, 'projects' => $projects ));
    }


    public function showArchiveAction(Request $request){

      $current_user = $this->getUser();
      $myProjects = $current_user->getMesProjets() ;
      foreach ($myProjects as $project) {
        if($project->isActive()){
          $myProjects->removeElement($project) ;
        }
      }
      $projects = $current_user->getProjets();
      foreach ($projects as $project) {
        if(!$project->isActive()){
          $projects->removeElement($project) ;
        }
      }

      $archivedProjets = new ArrayCollection(
        array_merge($myProjects->toArray(), $projects->toArray())
      );

      return $this->render('EasyScrumEasyScrumBundle:Projet:archivedProjectsVue.html.twig', array('archivedProjects' => $archivedProjets ));
    }

    public function editProjectAction(Request $request){
      $em = $this->getDoctrine()->getManager();



      $form = $this->createForm(editProjectType::class);
      //On fait le lien Requête <-> formulaire
      $form->handleRequest($request);

      //On vérifie que les valeurs entrées sont correctes
      if($form->isValid() && $form->isSubmitted())
      {
        $project_id = $_POST['projectToEdit_id'];
        var_dump($project_id);
        $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');
        $projet = $repository->findProjectById($project_id);

        $nom = $form->get('nom')->getData();
        $description = $form->get('description')->getData();
        $owner = $projet[0]->getProductOwner();

        $existingProject = $repository->findProjectByName_user($owner, $nom);
        if($existingProject){
          $this->addFlash(
             'success',
             'Un projet avec le même nom existe déja '
         );
           return $this->redirectToRoute('easy_scrum_dashbord');
        } else {

        $projet[0]->setNom($nom);
        $projet[0]->setDescription($description);
        $em->merge($projet[0]);
        $em->flush();
        $this->addFlash(
           'success',
           'Le projet est mis à jour!'
       );
         return $this->redirectToRoute('easy_scrum_dashbord');
       }
      }
       return $this->render('EasyScrumEasyScrumBundle:Projet:projectEditVue.html.twig', array('form' =>$form->createView()));
    }
    //Affichage des release d'un projet

    public function showProjectAction($id){

      $em = $this->getDoctrine()->getManager();

      $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');

      $projet = $repository->findProjectById($id);

      if(!$projet){
        throw $this->createNotFoundException('projet non trouvé.');
      }
      else {
        $releases = $projet[0]->getReleases();
      }
      return $this->render('EasyScrumEasyScrumBundle:Projet:projetView.html.twig', array('listReleases' => $releases,'id' =>$id));
    }

    public function archiveAction(){
      $project_id = $_POST['projectToarchive_id'] ;
      $em = $this->getDoctrine()->getManager();

      $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');

      $projet = $repository->findProjectById($project_id);
      $projet[0]->setActive(0) ;

      $em->merge($projet[0]);
      $em->flush();
      $this->addFlash(
         'success',
         'Le projet est bien archivé!'
     );
       return $this->redirectToRoute('easy_scrum_dashbord');
    }
    public function activeAction(){
      $project_id = $_POST['projectToActive_id'];
      $em = $this->getDoctrine()->getManager();

      $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');

      $projet = $repository->findProjectById($project_id);
      $projet[0]->setActive(1) ;

      $em->merge($projet[0]);
      $em->flush();
      $this->addFlash(
         'success',
         'Le projet est bien activé!'
     );

     return $this->redirectToRoute('easy_scrum_dashbord');
    }


}
