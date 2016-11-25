<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjetController extends Controller

{
  public function indexAction()
  {
      return $this->render('EasyScrumEasyScrumBundle:Default:projetVue.html.twig');
  }

}
