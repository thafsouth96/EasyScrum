<?php

namespace EasyScrum\EasyScrumBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EasyScrumEasyScrumBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
