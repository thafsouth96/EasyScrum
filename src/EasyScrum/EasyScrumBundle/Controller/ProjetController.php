<?php

namespace EasyScrum\EasyScrumBundle\Controller;


use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EasyScrum\EasyScrumBundle\Entity\Projet;
use EasyScrum\EasyScrumBundle\Form\CreateProject;

class ProjetController extends Controller

{
    public function indexAction()
    {
        return $this->render('EasyScrumEasyScrumBundle:Default:projetVue.html.twig');
    }
    public function createAction(Request $request)
    {
      //On crée l'objet projet
      $projet = new Projet();


      // On génère le formulaire à partir de l'objet createProjet dans Form
      $form = $this->createForm(CreateProject::class, $projet);

    //On fait le lien Requête <-> formulaire
    $form->handleRequest($request);

    //On vérifie que les valeurs entrées sont correctes

    if($form->isValid() && $form->isSubmitted()){
      $current_user = $this->getUser() ;
      $nom = $form->get('nom')->getData();
      $projet->setNom($nom);
      $projet->setProductOwner($current_user);

      $current_user->addProjet($projet);
      //on enregistre l'objet projet dans la base de données
      $em = $this->getDoctrine()->getManager();

      $em->persist($projet);
      $em->flush();

      //Redirection vers la vue projet "createProject à modifier "
      //return $this->redirectToRoute('project_create');
    return new Response('Projet'.$nom. 'Created ! ');
    }
    return $this->render('EasyScrumEasyScrumBundle:Projet:projetCreateVue.html.twig', array('form' =>$form->createView()));
  }
    public function showProjectsAction(Request $request){

      $current_user = $this->getUser();
        $listProjets = $current_user->getProjets() ;
        return $this->render('EasyScrumEasyScrumBundle:Projet:projetsVue.html.twig', array('listProjets' => $listProjets));
    }

    public function projetViewAction($id){

      $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('EasyScrumEasyScrumBundle:Projet');

        $projet = $repository->find($id) ;
          if (!$projet) {
              throw $this->createNotFoundException('projet non trouvé.');
            }

        return $this->render('EasyScrumEasyScrumBundle:Projet:projetVue.html.twig', array('projet' => $projet));
    }

}
