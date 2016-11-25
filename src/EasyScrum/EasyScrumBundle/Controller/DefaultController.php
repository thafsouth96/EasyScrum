<?php

namespace EasyScrum\EasyScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EasyScrumEasyScrumBundle:Default:index.html.twig');
    }
    public function dashboardAction()
    {
      return $this->render('EasyScrumEasyScrumBundle:Default:dashboard.html.twig');
    }
}
