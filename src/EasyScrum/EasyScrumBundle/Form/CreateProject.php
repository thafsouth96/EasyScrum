<?php
 namespace EasyScrum\EasyScrumBundle\Form ;

use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Form\FormBuilderInterface;
use EasyScrum\EasyScrumBundle\Entity\Projet ;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CreateProject extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('nom', TextType::class, array(
          'label' => 'Nom',
          'required' => true,
    ))
    ->add('description', TextType::class, array(
          'label' => 'Description',
          'required' => false,

    ))
    ->add('dateDebut' , DateType::class, array(
          'label' => 'Date Début',
          'required' => false,
    ))
    ->add('dateFin', DateType::class, array(
          'label' =>'Date Fin',
          'required' => false,
    ));
/*    ->add('productOwner', ChoiceType::class, array(
          'choices' => array(
            '1'=> 1 ,
            '2'=> 2
          ),
          'placeholder'=>'Sélectionner un productOwner',
          'label' => 'Product owner',
          'required' => false
    ))*/
  /*    ->add('productOwner', EntityType::class, array(
            'class' => 'EasyScrumEasyScrumBundle:User',
            'choices'=> $projet->getCollaborateurs(),
      ))*/

  /*  ->add('budget', IntegerType::class, array(
          'label' => 'Budget',
          'required' => false
    ))*/

  }
    public function getName()
    {
      return "createProjectForm";
    }

  }
