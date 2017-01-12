<?php

namespace EasyScrum\EasyScrumBundle\Controller;


use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use EasyScrum\EasyScrumBundle\Entity\Projet;
use EasyScrum\EasyScrumBundle\Form\CreateProject;
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
      $listMesProjets = $current_user->getMesProjets() ;
      $listProjets = $current_user->getProjets();

      $allProjets = new ArrayCollection(
        array_merge($listMesProjets->toArray(), $listProjets->toArray())
      );

      return $this->render('EasyScrumEasyScrumBundle:Projet:allprojetsVue.html.twig', array('allProjets' => $allProjets));
    }

    public function editProjectAction($name){

      $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');

        $projet = $repository->findProjectByName($name) ;


          if (!$projet) {
              throw $this->createNotFoundException('projet non trouvé.');
            }

        return $this->render('EasyScrumEasyScrumBundle:Projet:projetVue.html.twig', array('projet' => $projet));
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

}
