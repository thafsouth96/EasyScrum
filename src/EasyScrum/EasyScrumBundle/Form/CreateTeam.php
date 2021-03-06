<?php
 namespace EasyScrum\EasyScrumBundle\Form ;

use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Form\FormBuilderInterface;
use EasyScrum\EasyScrumBundle\Entity\Team ;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class CreateTeam extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $this->current_user = $options['current_user'];

    $builder
    ->add('nom', TextType::class, array(
          'label' => 'Nom',
          'required' => true,
    ))
    ->add('description', TextType::class, array(
          'label' => 'Description',
          'required' => false,

    )); 

  }

  public function configureOptions(OptionsResolver $resolver){

    $resolver->setDefaults(array(
        'data_calss' => 'EasyScrum\EasyScrumBundle\Entity\Team',
         'current_user'      => null,
    ));
  }


  public function getName()
  {
    return "CreateTeamForm";
  }


  }
